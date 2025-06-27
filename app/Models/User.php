<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'is_admin'];

    protected static function boot()
    {
        parent::boot();

        // Use `created()` instead of `saving()`
        static::created(function ($user) {
            if ($user->is_admin) {
                // Check if user is already an admin
                if (!\DB::table('admins')->where('user_id', $user->id)->exists()) {
                    \DB::table('admins')->insert([
                        'user_id' => $user->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });
    }

    /**
     * Get the donations associated with the user.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get the volunteer activities associated with the user.
     */
    public function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }
}
