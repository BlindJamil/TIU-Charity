<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cause;
use App\Models\Donation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationReceiptMail;
use Illuminate\Support\Facades\Log;

class UserDonationController extends Controller
{
    /**
     * Show donation form
     */
    public function showForm($id)
    {
        // Get the cause
        $cause = Cause::findOrFail($id);
        
        // If user is logged in, prepare user data for auto-fill
        $userData = null;
        if (auth()->check()) {
            $user = auth()->user();
            $userData = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '', // Assuming user table has phone field
            ];
        }
        
        return view('donation-form', compact('cause', 'userData'));
    }

    /**
     * Process donation
     */
    public function store(Request $request)
    {
        // Validate the donation data
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
            'cause_id' => 'required|exists:causes,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'nullable|string',
            'terms_agreed' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Generate a unique receipt number
        $receiptNumber = 'DON-' . date('Ymd') . '-' . rand(1000, 9999);
        
        // Get the cause
        $cause = Cause::findOrFail($request->input('cause_id'));
        
        // Calculate receipt expiration date (default to 7 days if not set)
        $expirationDays = $cause->receipt_expiry_days ?? 7;
        $expirationDate = now()->addDays($expirationDays)->format('Y-m-d H:i:s');

        // Create the donation
        $donation = new Donation();
        $donation->cause_id = $request->input('cause_id');
        $donation->name = $request->input('name');
        $donation->email = $request->input('email');
        $donation->phone = $request->input('phone');
        $donation->amount = $request->input('amount');
        $donation->payment_method = 'cash';
        $donation->message = $request->input('message');
        $donation->anonymous = false; // Always set to false since we removed this option
        $donation->status = 'pending';
        $donation->donation_type = 'cash';
        $donation->transaction_id = $receiptNumber;
        $donation->receipt_expires_at = $expirationDate;
        
        // Associate with logged-in user if authenticated
        if (auth()->check()) {
            $donation->user_id = auth()->id();
        }
        
        $donation->save();
        
        // Add the cause title to the donation for the email
        $donation->cause_title = $cause->title;
        
        // Send receipt email if email is provided
        if ($donation->email) {
            try {
                Mail::to($donation->email)->send(new DonationReceiptMail($donation));
            } catch (\Exception $e) {
                // Log the error but don't stop the process
                Log::error('Failed to send donation receipt email: ' . $e->getMessage());
            }
        }
        
        // Redirect to thank you page
        return redirect()->route('donation.thank-you', $donation->id);
    }
    
    /**
     * Show thank you page after donation
     */
    public function thankYou($id)
    {
        // Get the donation
        $donation = DB::table('donations')
            ->join('causes', 'donations.cause_id', '=', 'causes.id')
            ->select(
                'donations.*',
                'causes.title as cause_title'
            )
            ->where('donations.id', $id)
            ->first();
            
        if (!$donation) {
            return redirect()->route('home')
                ->with('error', 'Donation not found');
        }
        
        return view('donation-receipt', compact('donation'));
    }
    
    /**
     * Handle payment gateway callback
     */
    public function handlePaymentCallback(Request $request)
    {
        // Log all parameters for debugging
        Log::info('Payment callback received', $request->all());
        
        // Get the transaction ID from the callback
        $transactionId = $request->input('transaction_id');
        
        if (!$transactionId) {
            Log::error('Payment callback missing transaction ID');
            return response()->json(['status' => 'error', 'message' => 'Transaction ID not provided'], 400);
        }
        
        // Find the donation with this transaction ID
        $donation = Donation::where('transaction_id', $transactionId)->first();
        
        if (!$donation) {
            Log::error('Payment callback for unknown transaction: ' . $transactionId);
            return response()->json(['status' => 'error', 'message' => 'Donation not found'], 404);
        }
        
        // Process the payment status
        $paymentStatus = $request->input('payment_status');
        
        if ($paymentStatus === 'completed' || $paymentStatus === 'success') {
            // Update donation status to completed
            $donation->status = 'completed';
            $donation->completed_at = now();
            $donation->save();
            
            // Update the cause's raised amount
            $cause = Cause::find($donation->cause_id);
            if ($cause) {
                $cause->raised = $cause->raised + $donation->amount;
                $cause->save();
            }
            
            Log::info('Payment completed for donation: ' . $donation->id);
            return response()->json(['status' => 'success', 'message' => 'Payment processed successfully']);
        } elseif ($paymentStatus === 'failed' || $paymentStatus === 'cancelled') {
            // Update donation status to failed
            $donation->status = 'failed';
            $donation->save();
            
            Log::info('Payment failed for donation: ' . $donation->id);
            return response()->json(['status' => 'success', 'message' => 'Payment failure recorded']);
        } else {
            // Unknown status
            Log::warning('Unknown payment status: ' . $paymentStatus . ' for donation: ' . $donation->id);
            return response()->json(['status' => 'warning', 'message' => 'Unknown payment status']);
        }
    }
}