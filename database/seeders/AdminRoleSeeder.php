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
        DB::table('admin_roles')->insert([
            'name' => 'super_admin',
            'display_name' => 'Super Admin',
            'description' => 'Has full access to all features of the system',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 