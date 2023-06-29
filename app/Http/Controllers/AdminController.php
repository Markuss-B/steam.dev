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
    
}
