<?php

namespace Tests\Feature\App\Services;

use App\Models\Device;
use App\Services\DeviceService;
use App\Services\NotificationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeviceServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_it_returns_all_devices_ordered_by_last_seen_time_desc()
    {
        Device::factory()->create(['last_seen_time' => now()->subMinutes(10)]);
        Device::factory()->create(['last_seen_time' => now()->subMinutes(5)]);
        Device::factory()->create(['last_seen_time' => now()]);

        $notificationService = $this->createMock(NotificationService::class);
        $service = new DeviceService($notificationService);

        $devices = $service->getAll();

        $this->assertCount(3, $devices);
        $this->assertTrue($devices[0]->last_seen_time->greaterThanOrEqualTo($devices[1]->last_seen_time));
        $this->assertTrue($devices[1]->last_seen_time->greaterThanOrEqualTo($devices[2]->last_seen_time));
    }

    public function test_it_updates_existing_device_instead_of_creating_new_one()
    {
        $existing = Device::factory()->create([
            'ip' => '192.168.0.10',
            'mac' => '00:00:00:00:00:01',
            'manufacturer' => 'Unknown',
            'last_seen_time' => now()->subHour(),
        ]);

        $newData = [
            [
                'ip' => '192.168.0.10',
                'mac' => '00:00:00:00:00:01',
                'manufacturer' => 'Apple',
            ]
        ];

        $notificationService = $this->createMock(NotificationService::class);
        $notificationService->expects($this->once())
            ->method('notifyNewDevice')
            ->with($this->isInstanceOf(Device::class));

        $service = new DeviceService($notificationService);

        $service->create($newData);

        $this->assertEquals(1, Device::count());

        $this->assertDatabaseHas('devices', [
            'ip' => '192.168.0.10',
            'manufacturer' => 'Apple',
        ]);
    }
}
