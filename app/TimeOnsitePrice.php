<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeOnsitePrice extends Model
{
    protected $table = 'time_onsite_prices';
    protected $fillable = [
        'time_onsite_id', 'level_id', 'price'
    ];

    public function timeOnsite()
    {
        return $this->belongsTo(TimeOnsite::class, 'time_onsite_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
}
