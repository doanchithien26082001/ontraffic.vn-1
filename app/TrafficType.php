<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrafficType extends Model
{
    protected $table = 'traffic_types';
    protected $fillable = [
        'traffic_name'
    ];
}
