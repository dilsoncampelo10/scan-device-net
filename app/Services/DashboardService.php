<?php

namespace App\Services;

use App\Models\Device;
use Illuminate\Support\Facades\DB;

class DashboardService
{

    public function getDashboardData()
    {
        return [
            'devicesByDay' => $this->getDevicesByDay(),
            'devicesByManufacturer' => $this->getDevicesByManufacturer(),
            'deviceStatus' => $this->getDeviceStatus(),
        ];
    }

    private function getDevicesByDay()
    {
        return Device::select(
            DB::raw('DATE(last_seen_time) as date'),
            DB::raw('count(*) as total')
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getDevicesByManufacturer()
    {
        return Device::select('manufacturer', DB::raw('count(*) as total'))
            ->groupBy('manufacturer')
            ->orderByDesc('total')
            ->get();
    }

    private function getDeviceStatus(): array
    {
        $now = now();

        $active = Device::where('last_seen_time', '>=', $now->copy()->subMinutes(5))->count();

        $recent = Device::whereBetween('last_seen_time', [
            $now->copy()->subMinutes(30),
            $now->copy()->subMinutes(5)
        ])->count();

        $inactive = Device::where('last_seen_time', '<', $now->copy()->subMinutes(30))->count();

        return [
            'active' => $active,
            'recent' => $recent,
            'inactive' => $inactive,
        ];
    }
}
