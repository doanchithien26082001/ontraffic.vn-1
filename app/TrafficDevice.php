<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrafficDevice extends Model
{
    protected $table = 'traffic_devices';
    protected $fillable = [
        'traffic_id', 'device_id'
    ];
}
