<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Traits\AdminAuditLog;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, AdminAuditLog;

    protected $table = 'admin_users';
    
    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_role_user', 'admin_user_id', 'admin_role_id');
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->where('name', $role)->count();
        }
        return !! $role->intersect($this->roles)->count();
    }

    // app/Models/Admin.php

public function hasPermission($permission)
{
    return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
        $query->where('name', $permission);
    })->exists();
}

    public function hasAnyPermission($permissions)
    {
        if (is_string($permissions)) {
            $permissions = [$permissions];
        }

        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    public function hasAllPermissions($permissions)
    {
        if (is_string($permissions)) {
            $permissions = [$permissions];
        }

        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }
        return true;
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super_admin');
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }
        $this->roles()->syncWithoutDetaching($role);
    }

    public function removeRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }
        $this->roles()->detach($role);
    }

    public function syncRoles($roles)
    {
        if (is_array($roles)) {
            $roles = Role::whereIn('name', $roles)->get();
        }
        $this->roles()->sync($roles);
    }
}
