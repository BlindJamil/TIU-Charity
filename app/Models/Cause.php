<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'goal',
        'raised',
        'image',
        'receipt_expiry_days',
        'is_recent',
        'is_urgent'
    ];

    /**
     * Get the donations for the cause.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
    
    /**
     * Get the completed donations for the cause.
     */
    public function completedDonations()
    {
        return $this->hasMany(Donation::class)->where('status', 'completed');
    }
    
    /**
     * Get the percentage of the goal that has been raised.
     */
    public function getProgressPercentageAttribute()
    {
        if ($this->goal == 0) {
            return 0;
        }
        
        return min(100, round(($this->raised / $this->goal) * 100));
    }
}