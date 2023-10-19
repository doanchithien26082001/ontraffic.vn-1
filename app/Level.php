<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';
    protected $fillable = [
        'traffic_type_id', 'hook', 'discount'
    ];
    public function getTrafficType()
    {
        return $this->belongsTo(TrafficType::class, 'traffic_type_id');
    }
    public function userLevels()
    {
        return $this->hasMany(UserLevel::class);
    }
    public function timeOnsitePrices()
    {
        return $this->hasMany(TimeOnsitePrice::class, 'level_id');
    }
}
