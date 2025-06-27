<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'cause_id',
        'name',
        'email',
        'phone',
        'amount',
        'transaction_id',
        'payment_method',
        'status',
        'message',
        'anonymous',
        'receipt_expires_at',
        'completed_at',
        'admin_notes'
    ];

    /**
     * Get the user that made the donation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cause that the donation was made to.
     */
    public function cause()
    {
        return $this->belongsTo(Cause::class);
    }
}