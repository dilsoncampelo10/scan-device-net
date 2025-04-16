<?php

namespace Tests\Feature\App\Services;

use App\Models\Device;
use App\Services\DashboardService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DashboardServiceTest extends TestCase
{
    use RefreshDatabase;

    protected DashboardService $dashboardService;

    protected function setUp(): void
    {
        parent::setUp();

     
        Device::factory()->count(2)->create([
            'last_seen_time' => now()->subMinutes(10),
            'manufacturer' => 'Manufacturer A',
        ]);

        Device::factory()->count(2)->create([
            'last_seen_time' => now()->subMinutes(35),
            'manufacturer' => 'Manufacturer B',
        ]);

      
        $this->dashboardService = new DashboardService();
    }

    public function testGetDashboardData()
    {
      
        $dashboardData = $this->dashboardService->getDashboardData();

      
        $this->assertArrayHasKey('devicesByDay', $dashboardData);
        $this->assertArrayHasKey('devicesByManufacturer', $dashboardData);
        $this->assertArrayHasKey('deviceStatus', $dashboardData);

  
        $this->assertCount(1, $dashboardData['devicesByDay']);

       
        $this->assertCount(2, $dashboardData['devicesByManufacturer']);
    }

    public function testGetDevicesByDay()
    {

        $result = $this->dashboardService->getDevicesByDay();

        $this->assertCount(1, $result);
        $this->assertEquals('2025-04-16', $result[0]->date);
    }

    public function testGetDevicesByManufacturer()
    {

        $result = $this->dashboardService->getDevicesByManufacturer();


        $this->assertCount(2, $result);
    }

    public function testGetDeviceStatus()
    {
        
        Carbon::setTestNow($now = now());

 
        Device::query()->delete();

    
        Device::factory()->create([
            'last_seen_time' => $now->copy()->subMinutes(2), 
        ]);

        Device::factory()->create([
            'last_seen_time' => $now->copy()->subMinutes(10), 
        ]);

        Device::factory()->create([
            'last_seen_time' => $now->copy()->subMinutes(40),
        ]);

       
        DB::setDefaultConnection(config('database.default'));


        $result = $this->dashboardService->getDeviceStatus();

  
        $this->assertEquals(1, $result['active']);
        $this->assertEquals(1, $result['recent']);
        $this->assertEquals(1, $result['inactive']);
    }
}
