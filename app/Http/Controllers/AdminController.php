<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ContactMessage;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get all counts and data at once
        $contactMessagesCount = ContactMessage::count();
        $donationCount = DB::table('donations')->count();
        $volunteerCount = DB::table('volunteers')->count();
        $recentDonations = DB::table('donations')->orderBy('created_at', 'desc')->limit(5)->get();
        
        // Return view with all data
        return view('admin.dashboard', compact(
            'contactMessagesCount',
            'donationCount', 
            'volunteerCount', 
            'recentDonations'
        ));
    }

    public function donations()
    {
        return redirect()->route('admin.donations.index');
    }
    
    public function settings()
    {
        $settings = DB::table('settings')->first();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        DB::table('settings')->update([
            'enable_money_donations' => $request->has('enable_money_donations'),
            'enable_clothes_donations' => $request->has('enable_clothes_donations'),
            'enable_food_donations' => $request->has('enable_food_donations'),
            'updated_at' => now(),
        ]);
        
        return redirect()->route('admin.settings')->with('success', 'Settings updated!');
    }
/**
 * Export donations to CSV file
 * 
 * @return \Symfony\Component\HttpFoundation\StreamedResponse
 */
public function export()
{
    // Get all donations with cause title
    $donations = DB::table('donations')
        ->leftJoin('causes', 'donations.cause_id', '=', 'causes.id')
        ->select(
            'donations.id',
            'donations.name',
            'donations.email',
            'donations.phone',
            'donations.amount',
            'donations.transaction_id',
            'donations.status',
            'donations.message',
            'causes.title as cause_title',
            'donations.created_at'
        )->get();

    // Set up the CSV file
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="donations-export-' . date('Y-m-d') . '.csv"',
        'Pragma' => 'no-cache',
        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        'Expires' => '0'
    ];

    $callback = function() use ($donations) {
        $file = fopen('php://output', 'w');
        
        // Add header row
        fputcsv($file, [
            'ID',
            'Donor Name',
            'Email',
            'Phone',
            'Amount',
            'Receipt #',
            'Status',
            'Cause',
            'Message',
            'Donation Date'
        ]);
        
        // Add data rows
        foreach ($donations as $donation) {
            fputcsv($file, [
                $donation->id,
                $donation->name ?? 'Anonymous',
                $donation->email ?? 'Not provided',
                $donation->phone ?? 'Not provided',
                number_format($donation->amount, 2),
                $donation->transaction_id,
                ucfirst($donation->status),
                $donation->cause_title ?? 'General Donation',
                $donation->message ?? '',
                date('Y-m-d H:i:s', strtotime($donation->created_at))
            ]);
        }
        
        fclose($file);
    };
    
    return response()->stream($callback, 200, $headers);
}
}