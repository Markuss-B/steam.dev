<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        if($search) {
            $users = User::where('name', 'like', '%' . $search . '%')->paginate(15);
        } else {
            $users = User::paginate(15);
        }
        
        return view('profile.index', ['users' => $users]);
    }
    

    public function show($user = null)
    {
        if ($user === null) {
            $user = Auth::user();
        } else if (Auth::user() == $user) {
            return Redirect::route('profile.show');
        }

        return view('profile.show', compact('user'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {   
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile avatar.
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Validate the avatar upload
        $data = $request->validate([
            'avatar' => ['image', 'nullable', 'max:5000'],
        ]);

        // Handle the user's avatar upload
        if ($request->hasFile('avatar')) {
            // Delete the old avatar from storage
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store the new avatar
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        };

        $user->update($data);

        return Redirect::route('profile.edit')->with('status', 'avatar-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
