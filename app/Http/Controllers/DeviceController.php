<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        foreach ($request->devices as $device) {
            Device::updateOrCreate(
                ['ip' => $device['ip']],
                [
                    'mac' => $device['mac'] ?? null,
                    'manufacturer' => $device['manufacturer'] ?? null,
                    'last_seen_time' => now()
                ]
            );
        }
        return response()->json(['status' => 'ok']);
    }
}
