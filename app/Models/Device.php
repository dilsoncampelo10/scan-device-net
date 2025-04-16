<?php

namespace App\Models;

use App\Helpers\DeviceHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

class Device extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $auditInclude = [
        'ip',
        'mac',
        'manufacturer',
        'last_seen_time',
    ];

    protected $fillable = [
        'ip',
        'mac',
        'manufacturer',
        'last_seen_time'
    ];

    protected $casts = [
        'last_seen_time' => 'datetime',
    ];


    public function getStatusBadgeAttribute(): string
    {
        $lastSeen = Carbon::parse($this->last_seen_time);
        $diff = $lastSeen->diffInMinutes(now());

        return match (true) {
            $diff <= 5  => '<span class="badge bg-success">Ativo</span>',
            $diff <= 30 => '<span class="badge bg-warning text-dark">Recentemente</span>',
            default     => '<span class="badge bg-secondary">Inativo</span>',
        };
    }

    public function getDeviceIconAttribute(): array
    {
        return DeviceHelper::getDeviceIcon($this->manufacturer);
    }
}
