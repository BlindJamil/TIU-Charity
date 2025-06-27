<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions
        $permissions = [
            // Admin & Dashboard
            ['name' => 'view_dashboard', 'display_name' => 'View Dashboard', 'group' => 'admin'],
            ['name' => 'manage_admins', 'display_name' => 'Manage Administrators', 'group' => 'admin'],
            ['name' => 'manage_roles', 'display_name' => 'Manage Roles', 'group' => 'admin'],

            // Donations
            ['name' => 'view_donations', 'display_name' => 'View Donations', 'group' => 'donations'],
            ['name' => 'manage_donations', 'display_name' => 'Manage Donations', 'group' => 'donations'],

            // Causes
            ['name' => 'view_causes', 'display_name' => 'View Causes', 'group' => 'causes'],
            ['name' => 'manage_causes', 'display_name' => 'Manage Causes', 'group' => 'causes'],
            ['name' => 'approve_causes', 'display_name' => 'Approve Causes', 'group' => 'causes'],

            // Volunteers
            ['name' => 'view_volunteers', 'display_name' => 'View Volunteers', 'group' => 'volunteers'],
            ['name' => 'manage_volunteers', 'display_name' => 'Manage Volunteers', 'group' => 'volunteers'],

            // Departments (Projects)
            ['name' => 'view_departments', 'display_name' => 'View Departments', 'group' => 'departments'],
            ['name' => 'manage_departments', 'display_name' => 'Manage Departments', 'group' => 'departments'],

            // Contact Messages
            ['name' => 'view_messages', 'display_name' => 'View Messages', 'group' => 'messages'],
            ['name' => 'manage_messages', 'display_name' => 'Manage Messages', 'group' => 'messages'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], $permission);
        }

        // Define roles with their permissions
        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Administrator',
                'description' => 'Full access to all features of the application.',
                'permissions' => Permission::pluck('name')->toArray() // Super admin gets all permissions
            ],
            [
                'name' => 'dashboard_viewer',
                'display_name' => 'Dashboard Viewer',
                'description' => 'Can only view the main dashboard statistics. Has no editing permissions.',
                'permissions' => ['view_dashboard']
            ],
            [
                'name' => 'accounting_admin',
                'display_name' => 'Accounting Administrator',
                'description' => 'Manages financial records, views and manages donations.',
                'permissions' => ['view_dashboard', 'view_donations', 'manage_donations']
            ],
            [
                'name' => 'content_manager',
                'display_name' => 'Content Manager',
                'description' => 'Manages public content like causes and volunteer projects.',
                'permissions' => ['view_dashboard', 'view_causes', 'manage_causes', 'view_volunteers', 'manage_volunteers']
            ],
            [
                'name' => 'message_manager',
                'display_name' => 'Message Manager',
                'description' => 'Views and manages incoming contact messages from the public.',
                'permissions' => ['view_dashboard', 'view_messages', 'manage_messages']
            ]
        ];

        foreach ($roles as $roleData) {
            $permissionNames = $roleData['permissions'];
            unset($roleData['permissions']);
            
            $role = Role::firstOrCreate(['name' => $roleData['name']], $roleData);
            $permissionModels = Permission::whereIn('name', $permissionNames)->get();
            $role->permissions()->sync($permissionModels);
        }
    }
}