<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMail extends Command
{
    protected $signature = 'mail:test {email?}';
    protected $description = 'Send a test email to verify mail configuration';

    public function handle()
    {
        $email = $this->argument('email') ?: config('mail.from.address');
        
        $this->info("Sending test email to {$email}...");
        
        try {
            Mail::to($email)->send(new \App\Mail\TestEmail());
            $this->info('Test email sent successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to send test email: ' . $e->getMessage());
            $this->error('Check your mail configuration in .env file.');
        }
    }
} 