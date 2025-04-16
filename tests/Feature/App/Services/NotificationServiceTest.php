<?php

namespace Tests\Feature\App\Services;

use App\Models\Device;
use App\Notifications\NewDeviceAlert;
use App\Services\NotificationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NotificationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testNotifyNewDevice()
    {

        Notification::fake();

        $device = Device::factory()->create([
            'ip' => '192.168.1.1',
            'mac' => '00:14:22:01:23:45',
            'manufacturer' => 'Test Manufacturer',
            'last_seen_time' => now(),
        ]);

  
        $notificationService = new NotificationService();

   
        $notificationService->notifyNewDevice($device);

        
        Notification::assertNotSentTo(
            [$device], 
            NewDeviceAlert::class
        );
    }

    public function testNotifyNewDeviceWithNoRecentCreation()
    {
        Notification::fake();

        $device = Device::factory()->create([
            'ip' => '192.168.1.1',
            'mac' => '00:14:22:01:23:45',
            'manufacturer' => 'Test Manufacturer',
            'last_seen_time' => now(),
        ]);

        $device->wasRecentlyCreated = false;

        $notificationService = new NotificationService();

        $notificationService->notifyNewDevice($device);

        Notification::assertNotSentTo(
            [$device], 
            NewDeviceAlert::class 
        );
    }
}
