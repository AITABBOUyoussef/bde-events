<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  (Admin)
        User::updateOrCreate(
            ['email' => 'test@example.com'], 
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // student
        User::updateOrCreate(
            ['email' => 'youssef@example.com'], 
            [
                'name' => 'Youssef Ait Abbou',
                'password' => Hash::make('password'),
                'role' => 'student', 
            ]
        );
    }
}