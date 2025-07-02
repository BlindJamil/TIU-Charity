<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define admin_roles
        $adminRoles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Admin',
                'description' => 'Full access to all features',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert admin_roles if the table exists
        if (Schema::hasTable('admin_roles')) {
            foreach ($adminRoles as $role) {
                DB::table('admin_roles')->insertOrIgnore($role);
            }
        }

        // Add new admin roles
        \App\Models\Role::firstOrCreate([
            'name' => 'achievement_manager',
        ], [
            'display_name' => 'Achievement Manager',
            'description' => 'Can fully manage achievements (CRUD).',
        ]);
        \App\Models\Role::firstOrCreate([
            'name' => 'achievement_viewer',
        ], [
            'display_name' => 'Achievement Viewer',
            'description' => 'Can view achievements but not edit or delete.',
        ]);
        \App\Models\Role::firstOrCreate([
            'name' => 'users_manager',
        ], [
            'display_name' => 'Users Manager',
            'description' => 'Can fully manage users (CRUD).',
        ]);
        \App\Models\Role::firstOrCreate([
            'name' => 'users_viewer',
        ], [
            'display_name' => 'Users Viewer',
            'description' => 'Can view users but not edit or delete.',
        ]);
    }
} 