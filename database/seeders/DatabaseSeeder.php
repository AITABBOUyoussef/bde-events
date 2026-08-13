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
        
            ['name' => 'Loubna', 'email' => 'loubna@gmail.com', 'role' => 'student'],
          
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