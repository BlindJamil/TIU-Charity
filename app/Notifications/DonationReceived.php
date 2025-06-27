<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Donation;

class DonationReceived extends Notification
{
    use Queueable;

    protected $donation;

    /**
     * Create a new notification instance.
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail']; // Send both as database notification and email
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Thank You for Your Donation')
            ->line('We\'ve received your donation of $' . number_format($this->donation->amount, 2) . '.')
            ->line('Your support makes a real difference in our community.')
            ->action('View Your Donation', url('/profile/donations'))
            ->line('Thank you for your generosity!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Thank you for your donation of $' . number_format($this->donation->amount, 2) . '.',
            'donation_id' => $this->donation->id,
            'type' => 'donation_received',
            'amount' => $this->donation->amount
        ];
    }
}