<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Create dummy administrator users for development/testing.
     *
     * Login at: /login then you are redirected to the admin dashboard.
     *
     * Dummy admin logins:
     *   admin@edubridge.com  / password
     *   admin2@edubridge.com / admin123
     *   admin@edubridge.local / password  (legacy)
     *
     * Use plain passwords here; the User model's 'hashed' cast hashes them on save.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'administrator')->first();
        if (! $adminRole) {
            return;
        }

        $admins = [
            ['email' => 'admin@edubridge.com',   'name' => 'Admin User',        'password' => 'password'],
            ['email' => 'admin2@edubridge.com',  'name' => 'Secondary Admin',   'password' => 'admin123'],
            ['email' => 'admin@edubridge.local', 'name' => 'Administrator',     'password' => 'password'],
        ];

        foreach ($admins as $data) {
            $user = User::firstOrNew(['email' => $data['email']]);
            $user->role_id = $adminRole->id;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = $data['password']; // Model 'hashed' cast hashes this on save
            $user->save();
        }
    }
}
