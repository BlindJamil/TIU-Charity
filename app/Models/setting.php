<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'enable_money_donations',
        'enable_clothes_donations',
        'enable_food_donations',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'enable_money_donations' => 'boolean',
        'enable_clothes_donations' => 'boolean',
        'enable_food_donations' => 'boolean',
    ];
}