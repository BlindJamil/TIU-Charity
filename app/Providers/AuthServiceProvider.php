<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use App\Models\Permission;
use App\Models\Admin;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Dynamically register permissions with Laravel's Gate.
        try {
            // Check if the permissions table exists to avoid errors during migrations.
            if (Schema::hasTable('permissions')) {
                // Fetch all permissions from the database.
                Permission::all()->map(function ($permission) {
                    // Define a Gate for each permission.
                    Gate::define($permission->name, function (Admin $admin) use ($permission) {
                        // The Gate check will use the `hasPermission` method from your Admin model.
                        return $admin->hasPermission($permission->name);
                    });
                });
            }
        } catch (\Exception $e) {
            // Log any errors that occur during the process.
            Log::error('Could not register permissions in AuthServiceProvider: ' . $e->getMessage());
        }
    }
}