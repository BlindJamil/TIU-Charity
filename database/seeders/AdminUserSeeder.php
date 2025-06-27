<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Remove all existing admin users
        DB::table('admin_users')->truncate();
        DB::table('admin_role_user')->truncate();

        $admins = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'role' => 'super_admin',
            ],
            [
                'name' => 'Admin Manager',
                'email' => 'adminmanager@gmail.com',
                'role' => 'admin_manager',
            ],
            [
                'name' => 'Campaign Manager',
                'email' => 'campaignmanager@gmail.com',
                'role' => 'campaign_manager',
            ],
            [
                'name' => 'Donation Manager',
                'email' => 'donationmanager@gmail.com',
                'role' => 'donation_manager',
            ],
            [
                'name' => 'Volunteer Manager',
                'email' => 'volunteermanager@gmail.com',
                'role' => 'volunteer_manager',
            ],
            [
                'name' => 'Message Manager',
                'email' => 'messagemanager@gmail.com',
                'role' => 'message_manager',
            ],
            [
                'name' => 'Campaign Viewer',
                'email' => 'campaignviewer@gmail.com',
                'role' => 'campaign_viewer',
            ],
            [
                'name' => 'Donation Viewer',
                'email' => 'donationviewer@gmail.com',
                'role' => 'donation_viewer',
            ],
            [
                'name' => 'Volunteer Viewer',
                'email' => 'volunteerviewer@gmail.com',
                'role' => 'volunteer_viewer',
            ],
        ];

        foreach ($admins as $admin) {
            $userId = DB::table('admin_users')->insertGetId([
                'name' => $admin['name'],
                'email' => $admin['email'],
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $roleId = DB::table('admin_roles')->where('name', $admin['role'])->value('id');
            if ($roleId) {
                DB::table('admin_role_user')->insert([
                    'admin_user_id' => $userId,
                    'admin_role_id' => $roleId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
} 