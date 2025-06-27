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
            // Admins
            ['name' => 'manage_admins', 'display_name' => 'Manage Admins', 'group' => 'admins'],
            ['name' => 'view_admins', 'display_name' => 'View Admins', 'group' => 'admins'],
            // Campaigns
            ['name' => 'manage_campaigns', 'display_name' => 'Manage Campaigns', 'group' => 'campaigns'],
            ['name' => 'view_campaigns', 'display_name' => 'View Campaigns', 'group' => 'campaigns'],
            // Donations
            ['name' => 'manage_donations', 'display_name' => 'Manage Donations', 'group' => 'donations'],
            ['name' => 'view_donations', 'display_name' => 'View Donations', 'group' => 'donations'],
            // Volunteers
            ['name' => 'manage_volunteers', 'display_name' => 'Manage Volunteers', 'group' => 'volunteers'],
            ['name' => 'view_volunteers', 'display_name' => 'View Volunteers', 'group' => 'volunteers'],
            // Messages
            ['name' => 'manage_messages', 'display_name' => 'Manage Messages', 'group' => 'messages'],
            ['name' => 'view_messages', 'display_name' => 'View Messages', 'group' => 'messages'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], $permission);
        }

        // Define roles with their permissions
        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Admin',
                'description' => 'Full access to all features of the system',
                'permissions' => array_column($permissions, 'name'),
            ],
            [
                'name' => 'admin_manager',
                'display_name' => 'Admin Manager',
                'description' => 'Can manage admin users only',
                'permissions' => ['manage_admins', 'view_admins'],
            ],
            [
                'name' => 'campaign_manager',
                'display_name' => 'Campaign Manager',
                'description' => 'Can manage campaigns only',
                'permissions' => ['manage_campaigns', 'view_campaigns'],
            ],
            [
                'name' => 'donation_manager',
                'display_name' => 'Donation Manager',
                'description' => 'Can manage donations only',
                'permissions' => ['manage_donations', 'view_donations'],
            ],
            [
                'name' => 'volunteer_manager',
                'display_name' => 'Volunteer Manager',
                'description' => 'Can manage volunteers only',
                'permissions' => ['manage_volunteers', 'view_volunteers'],
            ],
            [
                'name' => 'message_manager',
                'display_name' => 'Message Manager',
                'description' => 'Can manage messages only',
                'permissions' => ['manage_messages', 'view_messages'],
            ],
            [
                'name' => 'campaign_viewer',
                'display_name' => 'Campaign Viewer',
                'description' => 'Can only view campaigns',
                'permissions' => ['view_campaigns'],
            ],
            [
                'name' => 'donation_viewer',
                'display_name' => 'Donation Viewer',
                'description' => 'Can only view donations',
                'permissions' => ['view_donations'],
            ],
            [
                'name' => 'volunteer_viewer',
                'display_name' => 'Volunteer Viewer',
                'description' => 'Can only view volunteers',
                'permissions' => ['view_volunteers'],
            ],
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