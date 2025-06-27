<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Donation;
use Carbon\Carbon;

class CheckExpiredReceipts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'donations:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for expired donation receipts and update their status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        
        // Find all pending donations that have expired receipt dates
        $expiredDonations = Donation::where('status', 'pending')
            ->where('receipt_expires_at', '<', $now)
            ->get();
            
        $count = count($expiredDonations);
        
        if ($count > 0) {
            $this->info("Found {$count} expired donation receipts.");
            
            foreach ($expiredDonations as $donation) {
                $donation->status = 'expired';
                $donation->admin_notes = $donation->admin_notes . "\nAutomatically marked as expired on " . $now->format('Y-m-d H:i:s');
                $donation->save();
                
                $this->line("Marked donation #{$donation->id} ({$donation->transaction_id}) as expired.");
            }
            
            $this->info("Successfully updated {$count} donation(s) to expired status.");
        } else {
            $this->info("No expired donation receipts found.");
        }
        
        return Command::SUCCESS;
    }
}