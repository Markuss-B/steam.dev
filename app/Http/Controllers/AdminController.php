<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        $permissions = $user->getAllPermissions();
    
        $permissions = $permissions->pluck('name');
    
        $models = [];
        foreach ($permissions as $permission) {
            if (fnmatch('own*', $permission)) {
                continue;
            }

            $parts = explode('.', $permission);
            $modelName = $parts[0];
            $action = $parts[1];
    
            if (!isset($models[$modelName])) {
                $models[$modelName] = [];
            }
    
            $models[$modelName][$action] = $permission;
        }
            
        return view('dashboard', compact('models'));
    }

    public function makeAdmin(Request $request)
    {
        $user = $request->user;
        // check if user is already an admin
        if ($user->hasRole('admin')) {
            return redirect()->back()->with('error_message', $user->name . ' is already an admin.');
        }
        $user->assignRole('admin');
        return redirect()->back()->with('success_message', $user->name . ' is now an admin.');
    }

    public function removeAdmin(Request $request)
    {
        $user = $request->user;
        // check if user is already not admin
        if (!$user->hasRole('admin')) {
            return redirect()->back()->with('error_message', $user->name . ' is not an admin.');
        }
        $user->removeRole('admin');
        return redirect()->back()->with('success_message', $user->name . ' is no longer an admin.');
    }

    public function makeDeveloper(Request $request)
    {
        $user = $request->user;
        // check if user is already a developer
        if ($user->hasRole('developer')) {
            return redirect()->back()->with('error_message', $user->name . ' is already a developer.');
        }
        $user->assignRole('developer');
        return redirect()->back()->with('success_message', $user->name . ' is now a developer.');
    }

    public function removeDeveloper(Request $request)
    {
        $user = $request->user;
        // check if user is already not a developer
        if (!$user->hasRole('developer')) {
            return redirect()->back()->with('error_message', $user->name . ' is not a developer.');
        }
        $user->removeRole('developer');
        return redirect()->back()->with('success_message', $user->name . ' is no longer a developer.');
    }
}
