<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Create a default administrator user (optional, for development).
     */
    public function run(): void
    {
        if (User::where('email', 'admin@edubridge.local')->exists()) {
            return;
        }

        User::create([
            'role_id' => 3, // administrator
            'name' => 'Administrator',
            'email' => 'admin@edubridge.local',
            'password' => Hash::make('password'),
        ]);
    }
}
