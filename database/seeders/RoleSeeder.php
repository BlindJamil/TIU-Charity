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
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'Limited administrative access',
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
    }
} 