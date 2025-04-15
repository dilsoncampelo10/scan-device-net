<?php

namespace App\Services;

use App\Models\Device;

class DeviceService
{
    public function getAll()
    {
        return Device::orderBy('last_seen_time', 'desc')->get();
    }

    public function create(array $devices)
    {
        foreach ($devices as $device) {
            Device::updateOrCreate(
                ['ip' => $device['ip']],
                [
                    'mac' => $device['mac'] ?? null,
                    'manufacturer' => $device['manufacturer'] ?? null,
                    'last_seen_time' => now()
                ]
            );
        }
    }
}
