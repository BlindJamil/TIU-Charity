<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * ADMIN Achievement Controller
 * 
 * This controller handles ADMIN management of achievements.
 * It provides CRUD operations for admins to manage completed projects.
 * 
 * FILE LOCATION: app/Http/Controllers/Admin/AchievementController.php
 */
class AchievementController extends Controller
{
    /**
     * Display a listing of achievements for admin
     */
    public function index()
    {
        $achievements = Achievement::ordered()->paginate(10);
        return view('admin.achievements.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new achievement
     */
    public function create()
    {
        $categories = Achievement::getCategories();
        return view('admin.achievements.create', compact('categories'));
    }

    /**
     * Store a newly created achievement in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'detailed_description' => 'required|string',
            'category' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'completion_date' => 'required|date',
            'location' => 'required|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'impact_stat_1_value' => 'required|string',
            'impact_stat_1_label' => 'required|string',
            'impact_stat_2_value' => 'required|string',
            'impact_stat_2_label' => 'required|string',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
            'status' => 'required|in:active,inactive',
            'volunteers' => 'required|integer|min:0',
            
            // Dynamic fields
            'detailed_stats' => 'nullable|array',
            'detailed_stats.*.value' => 'required_with:detailed_stats|string',
            'detailed_stats.*.label' => 'required_with:detailed_stats|string',
            'detailed_stats.*.description' => 'nullable|string',
            
            'financial_breakdown' => 'nullable|array',
            'financial_breakdown.*.category' => 'required_with:financial_breakdown|string',
            'financial_breakdown.*.amount' => 'required_with:financial_breakdown|numeric|min:0',
            
            'accomplishments' => 'nullable|array',
            'accomplishments.*' => 'string',
            
            'gallery_photos' => 'nullable|array',
            'gallery_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            
            'testimonials' => 'nullable|array',
            'testimonials.*.name' => 'required_with:testimonials|string',
            'testimonials.*.role' => 'required_with:testimonials|string',
            'testimonials.*.quote' => 'required_with:testimonials|string',
            
            'documents' => 'nullable|array',
            'documents.*.name' => 'required_with:documents|string',
            'documents.*.type' => 'required_with:documents|string',
            'documents.*.file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('achievements/main', 'public');
        }

        // Handle gallery photos upload
        if ($request->hasFile('gallery_photos')) {
            $galleryPhotos = [];
            foreach ($request->file('gallery_photos') as $index => $photo) {
                $path = $photo->store('achievements/gallery', 'public');
                $galleryPhotos[] = [
                    'url' => Storage::url($path),
                    'path' => $path, // Store path for deletion later
                    'caption' => $request->input("gallery_captions.{$index}", '')
                ];
            }
            $validated['gallery_photos'] = $galleryPhotos;
        }

        // Handle document uploads
        if ($request->has('documents')) {
            $documents = [];
            foreach ($request->input('documents') as $index => $document) {
                $documentData = [
                    'name' => $document['name'],
                    'type' => $document['type'],
                    'url' => '#'
                ];
                
                if ($request->hasFile("documents.{$index}.file")) {
                    $path = $request->file("documents.{$index}.file")->store('achievements/documents', 'public');
                    $documentData['url'] = Storage::url($path);
                    $documentData['path'] = $path; // Store path for deletion later
                }
                
                $documents[] = $documentData;
            }
            $validated['documents'] = $documents;
        }

        // Clean up arrays - remove empty values
        if (isset($validated['detailed_stats'])) {
            $validated['detailed_stats'] = array_filter($validated['detailed_stats'], function($stat) {
                return !empty($stat['value']) && !empty($stat['label']);
            });
        }

        if (isset($validated['financial_breakdown'])) {
            $validated['financial_breakdown'] = array_filter($validated['financial_breakdown'], function($item) {
                return !empty($item['category']) && !empty($item['amount']);
            });
        }

        if (isset($validated['accomplishments'])) {
            $validated['accomplishments'] = array_filter($validated['accomplishments'], function($item) {
                return !empty(trim($item));
            });
        }

        if (isset($validated['testimonials'])) {
            $validated['testimonials'] = array_filter($validated['testimonials'], function($testimonial) {
                return !empty($testimonial['name']) && !empty($testimonial['quote']);
            });
        }

        Achievement::create($validated);

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Achievement created successfully!');
    }

    /**
     * Display the specified achievement
     */
    public function show(Achievement $achievement)
    {
        return view('admin.achievements.show', compact('achievement'));
    }

    /**
     * Show the form for editing the specified achievement
     */
    public function edit(Achievement $achievement)
    {
        $categories = Achievement::getCategories();
        return view('admin.achievements.edit', compact('achievement', 'categories'));
    }

    /**
     * Update the specified achievement in storage
     */
    public function update(Request $request, Achievement $achievement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'detailed_description' => 'required|string',
            'category' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'completion_date' => 'required|date',
            'location' => 'required|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'impact_stat_1_value' => 'required|string',
            'impact_stat_1_label' => 'required|string',
            'impact_stat_2_value' => 'required|string',
            'impact_stat_2_label' => 'required|string',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
            'status' => 'required|in:active,inactive',
            'volunteers' => 'required|integer|min:0',
            
            // Dynamic fields
            'detailed_stats' => 'nullable|array',
            'financial_breakdown' => 'nullable|array',
            'accomplishments' => 'nullable|array',
            'testimonials' => 'nullable|array',
            'documents' => 'nullable|array',
        ]);

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            // Delete old image
            if ($achievement->main_image) {
                Storage::disk('public')->delete($achievement->main_image);
            }
            $validated['main_image'] = $request->file('main_image')->store('achievements/main', 'public');
        }

        // Handle gallery photo removal
        if ($request->has('remove_gallery_photos')) {
            $removeIndexes = array_map('intval', $request->input('remove_gallery_photos', []));
            $gallery = $achievement->gallery_photos ?? [];
            foreach ($removeIndexes as $idx) {
                if (isset($gallery[$idx]['path'])) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($gallery[$idx]['path']);
                }
                unset($gallery[$idx]);
            }
            // Re-index the array to avoid gaps
            $gallery = array_values($gallery);
            $achievement->gallery_photos = $gallery;
            $achievement->save();
        }

        // Handle gallery photos upload
        if ($request->hasFile('gallery_photos')) {
            // Delete old gallery photos
            if ($achievement->gallery_photos) {
                foreach ($achievement->gallery_photos as $photo) {
                    if (isset($photo['path'])) {
                        Storage::disk('public')->delete($photo['path']);
                    }
                }
            }
            
            $galleryPhotos = [];
            foreach ($request->file('gallery_photos') as $index => $photo) {
                $path = $photo->store('achievements/gallery', 'public');
                $galleryPhotos[] = [
                    'url' => Storage::url($path),
                    'path' => $path,
                    'caption' => $request->input("gallery_captions.{$index}", '')
                ];
            }
            $validated['gallery_photos'] = $galleryPhotos;
        }

        // Clean up arrays - remove empty values
        if (isset($validated['detailed_stats'])) {
            $validated['detailed_stats'] = array_filter($validated['detailed_stats'], function($stat) {
                return !empty($stat['value']) && !empty($stat['label']);
            });
        }

        if (isset($validated['financial_breakdown'])) {
            $validated['financial_breakdown'] = array_filter($validated['financial_breakdown'], function($item) {
                return !empty($item['category']) && !empty($item['amount']);
            });
        }

        if (isset($validated['accomplishments'])) {
            $validated['accomplishments'] = array_filter($validated['accomplishments'], function($item) {
                return !empty(trim($item));
            });
        }

        if (isset($validated['testimonials'])) {
            $validated['testimonials'] = array_filter($validated['testimonials'], function($testimonial) {
                return !empty($testimonial['name']) && !empty($testimonial['quote']);
            });
        }

        $achievement->update($validated);

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Achievement updated successfully!');
    }

    /**
     * Remove the specified achievement from storage
     */
    public function destroy(Achievement $achievement)
    {
        // Delete associated files
        if ($achievement->main_image) {
            Storage::disk('public')->delete($achievement->main_image);
        }
        
        if ($achievement->gallery_photos) {
            foreach ($achievement->gallery_photos as $photo) {
                if (isset($photo['path'])) {
                    Storage::disk('public')->delete($photo['path']);
                }
            }
        }
        
        if ($achievement->documents) {
            foreach ($achievement->documents as $document) {
                if (isset($document['path'])) {
                    Storage::disk('public')->delete($document['path']);
                }
            }
        }

        $achievement->delete();

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Achievement deleted successfully!');
    }

    /**
     * Toggle the status of an achievement (active/inactive)
     */
    public function toggleStatus(Achievement $achievement)
    {
        $achievement->update([
            'status' => $achievement->status === 'active' ? 'inactive' : 'active'
        ]);

        return back()->with('success', 'Achievement status updated successfully!');
    }

    /**
     * Toggle the featured status of an achievement
     */
    public function toggleFeatured(Achievement $achievement)
    {
        $achievement->update([
            'is_featured' => !$achievement->is_featured
        ]);

        return back()->with('success', 'Achievement featured status updated successfully!');
    }

    /**
     * Preview how the achievement looks on the public page
     */
    public function preview(Achievement $achievement)
    {
        // You can create a preview view or redirect to public page with specific achievement
        return redirect()->route('achievements')->with('preview', $achievement->id);
    }
}