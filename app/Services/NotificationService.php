<?php

namespace App\Services;

use App\Notifications\NewDeviceAlert;
use Illuminate\Support\Facades\Notification;

class NotificationService
{

    public function notifyNewDevice($device)
    {
        if ($device->wasRecentlyCreated) {

            Notification::route('mail', 'dilson.contato316@gmail.com')
                ->notify(new NewDeviceAlert($device));
        }
    }
}
