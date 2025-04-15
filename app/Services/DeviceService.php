<?php

namespace App\Services;

use App\Models\Device;
use App\Notifications\NewDeviceAlert;
use Illuminate\Support\Facades\Notification;

class DeviceService
{
    public function __construct(private NotificationService $notificationService) {}

    public function getAll()
    {
        return Device::orderBy('last_seen_time', 'desc')->get();
    }

    public function create(array $devices)
    {
        foreach ($devices as $device) {
            $createdDevice = Device::updateOrCreate(
                ['ip' => $device['ip']],
                [
                    'mac' => $device['mac'] ?? null,
                    'manufacturer' => $device['manufacturer'] ?? null,
                    'last_seen_time' => now()
                ]
            );

            $this->notificationService->notifyNewDevice($createdDevice);
        }
    }
}
