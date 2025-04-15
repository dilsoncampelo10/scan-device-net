<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    public function device()
    {
        $audits = Audit::with('auditable')
            ->where('auditable_type', Device::class)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('audits.device', compact('audits'));
    }
}
