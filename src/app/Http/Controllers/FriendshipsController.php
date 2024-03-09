<?php

namespace App\Http\Controllers;

use App\Models\Friendships;
use App\Models\User;
use App\Http\Requests\StoreFriendshipsRequest;
use App\Http\Requests\UpdateFriendshipsRequest;
use Illuminate\Support\Facades\Redirect;

class FriendshipsController extends Controller
{
    public function index()
    {
        $this->middleware('auth');

        return view('friendships.index');
    }

    public function sendFriendRequest(User $recipient)
    {
        $this->middleware('auth');

        $user = auth()->user();

        if ($user === $recipient) {
            return Redirect::back()->with('error_message', 'You cannot send a friend request to yourself.');
        }

        if ($user->hasSentFriendRequestTo($recipient)) {
            return Redirect::back()->with('error_message', 'Friend request already sent.');
        }

        if ($user->isFriendsWith($recipient)) {
            return Redirect::back()->with('error_message', 'You are already friends.');
        }

        if ($recipient->hasSentFriendRequestTo($user)) {
            $user->acceptFriendRequest($recipient);

            return Redirect::back()->with('success_message', 'Friend request accepted.');
        }

        $user->sendFriendRequest($recipient);

        return Redirect::back()->with('success_message', 'Friend request sent.');
    }

    public function acceptFriendRequest(User $sender)
    {
        $this->middleware('auth');

        $user = auth()->user();

        if (!$sender->hasSentFriendRequestTo($user)) {
            return Redirect::back()->with('error_message', 'You have not received a friend request from this user.');
        }

        $user->acceptFriendRequest($sender);

        return Redirect::back()->with('success_message', 'Friend request accepted.');
    }

    public function declineFriendRequest(User $sender)
    {
        $user = auth()->user();

        if (!$sender->hasSentFriendRequestTo($user)) {
            return Redirect::back()->with('error_message', 'You have not received a friend request from this user.');
        }

        $user->declineFriendRequest($sender);

        return Redirect::back()->with('success', 'Friend request declined.');
    }

    public function cancelFriendRequest(User $recipient)
    {
        $user = auth()->user();

        if ($user->isFriendsWith($recipient)) {
            return Redirect::back()->with('error_message', 'You are already friends.');
        }

        $user->cancelFriendRequest($recipient);

        return Redirect::back()->with('success_message', 'Friend request cancelled.');
    }

    public function unfriend(User $friend)
    {
        $user = auth()->user();

        if (!$user->isFriendsWith($friend)) {
            return Redirect::back()->with('error_message', 'You are not friends.');
        }

        $user->unfriend($friend);

        return Redirect::back()->with('success_message', 'Friend removed.');
    }
}
