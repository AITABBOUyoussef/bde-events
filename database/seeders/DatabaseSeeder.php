<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin Principal', 'email' => 'admin@test.com', 'role' => 'admin'],
            ['name' => 'Admin Youssef', 'email' => 'adminn@test.com', 'role' => 'admin'],
            
           ['name' => 'Youssef', 'email' => 'youssef@test.com', 'role' => 'student'],
            ['name' => 'Nisrina', 'email' => 'nisrina@test.com', 'role' => 'student'],
            ['name' => 'Wissal', 'email' => 'wissal@test.com', 'role' => 'student'],
            ['name' => 'Ali', 'email' => 'ali@test.com', 'role' => 'student'],
            ['name' => 'Sara', 'email' => 'sara@test.com', 'role' => 'student'],
        ];

        $now = Carbon::now();

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'email_verified_at' => $now,
                'password' => Hash::make($user['email']), 
                'role' => $user['role'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}