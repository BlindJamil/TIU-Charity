<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'admin_roles';

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_role_user', 'admin_role_id', 'admin_user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    public function hasPermission($permission)
    {
        if (is_string($permission)) {
            return $this->permissions->contains('name', $permission);
        }
        return !! $permission->intersect($this->permissions)->count();
    }

    public function givePermissionTo($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->firstOrFail();
        }
        $this->permissions()->syncWithoutDetaching($permission);
    }

    public function revokePermissionTo($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->firstOrFail();
        }
        $this->permissions()->detach($permission);
    }

    public function syncPermissions($permissions)
    {
        if (is_array($permissions)) {
            $permissions = Permission::whereIn('name', $permissions)->get();
        }
        $this->permissions()->sync($permissions);
    }
} 