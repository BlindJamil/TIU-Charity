<?php

namespace App\Listeners;

use App\Events\CauseCreated;
use App\Models\User;
use App\Notifications\NewCauseAdded;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUsersOfNewCause implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(CauseCreated $event): void
    {
        // Get users who might be interested in this cause
        $users = User::all(); // In a real app, you'd filter based on user preferences
        
        foreach ($users as $user) {
            $user->notify(new NewCauseAdded($event->cause));
        }
    }
}