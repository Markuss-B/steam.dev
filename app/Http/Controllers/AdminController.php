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

        
        return view('dashboard');
    }
}
