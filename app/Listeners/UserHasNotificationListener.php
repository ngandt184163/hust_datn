<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Events\UserHasNotificationEvent;

class UserHasNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserHasNotificationEvent $event)
    {
        // $newNotificationsCount = $event->newNotificationsCount;
        // $userIdDich = $event->userIdDich;
        $userId = $event->userId;
        \Log::info("Received new notification count: " . $newNotificationsCount . " for user: " . $userIdDich);
    }
}
