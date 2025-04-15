<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Services\DeviceService;
use Illuminate\Http\Request;

class DeviceController extends Controller
{

    public function __construct(private DeviceService $deviceService) {}

    public function index()
    {
        $devices = $this->deviceService->getAll();
        return view('devices.index', compact('devices'));
    }
    public function store(Request $request)
    {
        $this->deviceService->create($request->devices);
        return response()->json(['status' => 'ok']);
    }
}
