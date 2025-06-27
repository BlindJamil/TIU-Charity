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
        // Get admin credentials from environment variables or use defaults
        $admin = [
            'name' => env('ADMIN_NAME', 'Administrator'),
            'email' => env('ADMIN_EMAIL', 'admin@example.com'),
            'password' => Hash::make(env('ADMIN_PASSWORD', Str::random(16))), // Generate random password if not set
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Check if admin already exists
        $existingAdmin = DB::table('admin_users')->where('email', $admin['email'])->first();
        
        // Only create the admin if it doesn't already exist
        if (!$existingAdmin) {
            // Insert admin user and get the ID
            $adminId = DB::table('admin_users')->insertGetId($admin);
            
            // Output the generated credentials if using defaults
            if (!env('ADMIN_PASSWORD')) {
                $this->command->info('Generated admin credentials:');
                $this->command->info('Email: ' . $admin['email']);
                $this->command->info('Password: Please set ADMIN_PASSWORD in your .env file');
            }
        } else {
            $adminId = $existingAdmin->id;
        }

        // Handle role assignment for admin_roles table (new schema)
        if (Schema::hasTable('admin_roles')) {
            // Get the super_admin role ID
            $roleId = DB::table('admin_roles')->where('name', 'super_admin')->value('id');

            // Assign role to admin if not already assigned
            if ($roleId) {
                $existingRole = DB::table('admin_role_user')
                    ->where('admin_user_id', $adminId)
                    ->where('admin_role_id', $roleId)
                    ->first();
                    
                if (!$existingRole) {
                    DB::table('admin_role_user')->insert([
                        'admin_user_id' => $adminId,
                        'admin_role_id' => $roleId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
} 