<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $devicesByDay = Device::select(
            DB::raw('DATE(last_seen_time) as date'),
            DB::raw('count(*) as total')
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get();


        $devicesByManufacturer = Device::select('manufacturer', DB::raw('count(*) as total'))
            ->groupBy('manufacturer')
            ->orderByDesc('total')
            ->get();

        $now = now();
        $active = Device::where('last_seen_time', '>=', $now->copy()->subMinutes(5))->count();
        $recent = Device::whereBetween('last_seen_time', [
            $now->copy()->subMinutes(30),
            $now->copy()->subMinutes(5)
        ])->count();

        $inactive = Device::where('last_seen_time', '<', $now->copy()->subMinutes(30))->count();

        return view('dashboard', [
            'devicesByDay' => $devicesByDay,
            'devicesByManufacturer' => $devicesByManufacturer,
            'deviceStatus' => [
                'active' => $active,
                'recent' => $recent,
                'inactive' => $inactive
            ]
        ]);
    }
}
