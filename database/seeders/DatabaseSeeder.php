<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tài khoản Admin
        User::updateOrCreate(
            [
                'email' => 'admin@cinego.com',
            ],
            [
                'name' => 'Admin CineGo',
                'password' => '12345678',
                'role' => 'admin',
            ]
        );

        // Tài khoản User
        User::updateOrCreate(
            [
                'email' => 'user@cinego.com',
            ],
            [
                'name' => 'User CineGo',
                'password' => '12345678',
                'role' => 'user',
            ]
        );
    }
}