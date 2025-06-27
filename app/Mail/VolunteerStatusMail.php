<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VolunteerStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $volunteer;
    public $project;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct($volunteer, $project, $status)
    {
        $this->volunteer = $volunteer;
        $this->project = $project;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = 'Your Volunteer Application - ';
        
        if ($this->status === 'approved') {
            $subject .= 'Approved';
        } elseif ($this->status === 'rejected') {
            $subject .= 'Not Approved';
        } else {
            $subject .= 'Status Update';
        }
        
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.volunteer-status',
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