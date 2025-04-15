<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'ip',
        'mac',
        'manufacturer',
        'last_seen_time'
    ];
}
