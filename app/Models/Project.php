<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'volunteers_needed',
        'image',
    ];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    
    /**
     * Get the volunteers for the project
     */
    public function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }
}