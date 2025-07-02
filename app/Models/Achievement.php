<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'detailed_description',
        'category',
        'amount',
        'completion_date',
        'location',
        'main_image',
        'impact_stat_1_value',
        'impact_stat_1_label',
        'impact_stat_2_value',
        'impact_stat_2_label',
        'detailed_stats',
        'financial_breakdown',
        'accomplishments',
        'gallery_photos',
        'testimonials',
        'documents',
        'is_featured',
        'sort_order',
        'status',
        'volunteers'
    ];

    protected $casts = [
        'completion_date' => 'date',
        'amount' => 'decimal:2',
        'detailed_stats' => 'array',
        'financial_breakdown' => 'array',
        'accomplishments' => 'array',
        'gallery_photos' => 'array',
        'testimonials' => 'array',
        'documents' => 'array',
        'is_featured' => 'boolean'
    ];

    // Accessor for main image URL
    public function getMainImageUrlAttribute()
    {
        if ($this->main_image) {
            return Storage::url($this->main_image);
        }
        return asset('assets/img/donation1.jpg'); // Default image
    }

    // Accessor for formatted amount
    public function getFormattedAmountAttribute()
    {
        return '$' . number_format($this->amount, 0);
    }

    // Accessor for formatted completion date
    public function getFormattedCompletionDateAttribute()
    {
        return $this->completion_date->format('F Y');
    }

    // Scope for active achievements
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for featured achievements
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope for ordered achievements
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('completion_date', 'desc');
    }

    // Categories for select options
    public static function getCategories()
    {
        return [
            'Education' => 'Education',
            'Healthcare' => 'Healthcare',
            'Clean Water' => 'Clean Water',
            'Emergency' => 'Emergency Relief',
            'Food Aid' => 'Food Aid',
            'Technology' => 'Technology',
            'Infrastructure' => 'Infrastructure',
            'Environment' => 'Environment'
        ];
    }
}