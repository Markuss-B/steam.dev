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
        $parastais = User::create([
            'name' => 'parastais',
            'email' => 'parastais@gmail.com',
            'password' => Hash::make('parastais'),
        ]);

        $developer = User::create([
            'name' => 'developer',
            'email' => 'developer@gmail.com',
            'password' => Hash::make('developer'),
        ]);

        $developer->assignRole('developer');

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        $admin->assignRole('admin');
    }
}
