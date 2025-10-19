<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@fijiwebdirectory.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        User::create([
            'username' => 'testuser',
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);
    }
}