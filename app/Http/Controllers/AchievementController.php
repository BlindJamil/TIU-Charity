<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

/**
 * PUBLIC Achievement Controller
 * 
 * This controller handles the PUBLIC achievements page that visitors see.
 * It displays completed projects to build trust and transparency.
 * 
 * FILE LOCATION: app/Http/Controllers/AchievementController.php
 */
class AchievementController extends Controller
{
    /**
     * Display the public achievements page
     * Shows active, featured achievements to website visitors
     */
    public function index()
    {
        // Get achievements from database (only active and featured ones)
        $achievements = Achievement::active()
            ->featured()
            ->ordered()
            ->get()
            ->map(function ($achievement) {
                return [
                    'title' => is_array($achievement->title) ? implode(' ', $achievement->title) : (string) $achievement->title,
                    'description' => is_array($achievement->description) ? implode(' ', $achievement->description) : (string) $achievement->description,
                    'detailed_description' => is_array($achievement->detailed_description) ? implode(' ', $achievement->detailed_description) : (string) $achievement->detailed_description,
                    'category' => is_array($achievement->category) ? implode(' ', $achievement->category) : (string) $achievement->category,
                    'amount' => is_array($achievement->amount) ? implode(' ', $achievement->amount) : (string) $achievement->amount,
                    'completion_date' => is_array($achievement->formatted_completion_date) ? implode(' ', $achievement->formatted_completion_date) : (string) $achievement->formatted_completion_date,
                    'location' => is_array($achievement->location) ? implode(' ', $achievement->location) : (string) $achievement->location,
                    'main_image' => is_array($achievement->main_image_url) ? '' : (string) $achievement->main_image_url,
                    'impact_stat_1_value' => is_array($achievement->impact_stat_1_value) ? implode(' ', $achievement->impact_stat_1_value) : (string) $achievement->impact_stat_1_value,
                    'impact_stat_1_label' => is_array($achievement->impact_stat_1_label) ? implode(' ', $achievement->impact_stat_1_label) : (string) $achievement->impact_stat_1_label,
                    'impact_stat_2_value' => is_array($achievement->impact_stat_2_value) ? implode(' ', $achievement->impact_stat_2_value) : (string) $achievement->impact_stat_2_value,
                    'impact_stat_2_label' => is_array($achievement->impact_stat_2_label) ? implode(' ', $achievement->impact_stat_2_label) : (string) $achievement->impact_stat_2_label,
                    'detailed_stats' => $achievement->detailed_stats ?? [],
                    'financial_breakdown' => $achievement->financial_breakdown ?? [],
                    'accomplishments' => $achievement->accomplishments ?? [],
                    'gallery_photos' => $achievement->gallery_photos ?? [],
                    'testimonials' => $achievement->testimonials ?? [],
                    'documents' => $achievement->documents ?? [],
                ];
            });

        // Calculate overall stats from database for the hero section
        $allAchievements = Achievement::active()->get();
        $totalFunds = '$' . number_format($allAchievements->sum('amount'), 0);
        $totalProjects = $allAchievements->count();
        
        // Calculate total people helped from detailed stats
        $totalPeopleHelped = $allAchievements->reduce(function ($carry, $achievement) {
            $stats = $achievement->detailed_stats ?? [];
            foreach ($stats as $stat) {
                if (strpos(strtolower($stat['label'] ?? ''), 'people') !== false || 
                    strpos(strtolower($stat['label'] ?? ''), 'served') !== false ||
                    strpos(strtolower($stat['label'] ?? ''), 'helped') !== false ||
                    strpos(strtolower($stat['label'] ?? ''), 'assisted') !== false) {
                    $value = preg_replace('/[^0-9]/', '', $stat['value'] ?? '0');
                    $carry += (int) $value;
                }
            }
            return $carry;
        }, 0);
        
        // Format the people helped number
        if ($totalPeopleHelped > 1000) {
            $totalPeopleHelped = number_format($totalPeopleHelped / 1000, 0) . 'K';
        } else {
            $totalPeopleHelped = number_format($totalPeopleHelped);
        }
        
        // Calculate total volunteers from all achievements
        $totalVolunteers = $allAchievements->sum('volunteers');
        
        // Return the public achievements view
        return view('achievements', compact(
            'achievements', 
            'totalFunds', 
            'totalProjects', 
            'totalPeopleHelped', 
            'totalVolunteers'
        ));
    }
}