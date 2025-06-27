<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the super_admin role
        DB::table('admin_roles')->truncate();

        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Admin',
                'description' => 'Full access to all features of the system',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'admin_manager',
                'display_name' => 'Admin Manager',
                'description' => 'Can manage admin users only',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'campaign_manager',
                'display_name' => 'Campaign Manager',
                'description' => 'Can manage campaigns (causes) only',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'donation_manager',
                'display_name' => 'Donation Manager',
                'description' => 'Can manage donations only',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'volunteer_manager',
                'display_name' => 'Volunteer Manager',
                'description' => 'Can manage volunteers only',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'message_manager',
                'display_name' => 'Message Manager',
                'description' => 'Can manage messages only',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('admin_roles')->insert($roles);
    }
} 