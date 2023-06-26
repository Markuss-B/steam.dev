<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! User::where('name', 'parastais')->exists()) {
            $parastais = User::create([
                'name' => 'parastais',
                'email' => 'parastais@gmail.com',
                'password' => Hash::make('parastais'),
            ]);
        }

        // if developer already exists then don't create
        if (! User::where('name', 'developer')->exists()) {
            $developer = User::create([
                'name' => 'developer',
                'email' => 'developer@gmail.com',
                'password' => Hash::make('developer'),
            ]);
            $developer->assignRole('developer');
        } else {
            $developer = User::where('name', 'developer')->first();
            $developer->assignRole('developer');
        }


        if (! User::where('name', 'admin')->exists()) {
            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
            ]);
            $admin->assignRole('admin');
        } else {
            $admin = User::where('name', 'admin')->first();
            $admin->assignRole('admin');
        }

    }
}
