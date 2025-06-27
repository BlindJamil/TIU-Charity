<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {email?} {name?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a super admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? $this->ask('Enter admin email', 'admin@example.com');
        $name = $this->argument('name') ?? $this->ask('Enter admin name', 'Super Admin');
        $password = $this->argument('password') ?? $this->secret('Enter admin password (min 8 characters)') ?? 'adminpass123';

        // Check if admin already exists
        $existingAdmin = DB::table('admin_users')->where('email', $email)->first();
        
        if ($existingAdmin) {
            if (!$this->confirm("An admin with email {$email} already exists. Do you want to update it?")) {
                $this->info('Operation cancelled.');
                return 1;
            }
            
            // Update the admin
            DB::table('admin_users')
                ->where('email', $email)
                ->update([
                    'name' => $name,
                    'password' => Hash::make($password),
                    'updated_at' => now(),
                ]);
                
            $adminId = $existingAdmin->id;
            $this->info("Admin updated successfully!");
        } else {
            // Create new admin
            $adminId = DB::table('admin_users')->insertGetId([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $this->info("Admin created successfully!");
        }

        // Ensure admin_roles table has super_admin role
        $superAdminRole = DB::table('admin_roles')->where('name', 'super_admin')->first();
        
        if (!$superAdminRole) {
            $roleId = DB::table('admin_roles')->insertGetId([
                'name' => 'super_admin',
                'display_name' => 'Super Admin',
                'description' => 'Full access to all features',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->info("Super Admin role created.");
        } else {
            $roleId = $superAdminRole->id;
        }

        // Assign role to admin if not already assigned
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
            $this->info("Super Admin role assigned to the user.");
        }

        $this->info("Super Admin {$name} <{$email}> is ready to use!");
        return 0;
    }
} 