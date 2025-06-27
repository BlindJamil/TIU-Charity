<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Cause;

class DonationReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;
    public $cause;

    /**
     * Create a new message instance.
     */
    public function __construct($donation)
    {
        $this->donation = $donation;
        
        // Get the cause information if available
        if (!empty($donation->cause_id)) {
            $this->cause = Cause::find($donation->cause_id);
        }
        
        // If cause is not found, create a default object to avoid null errors
        if (empty($this->cause)) {
            $this->cause = new \stdClass();
            $this->cause->title = $donation->cause_title ?? 'General Donation';
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Donation Receipt - TIU Charity',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.donation-receipt',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}