<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeOnsite extends Model
{
    protected $table = 'time_onsites';
    protected $fillable = [
        'time_onsite_name'
    ];
    public function timeOnsitePrices()
    {
        return $this->hasMany(TimeOnsitePrice::class, 'time_onsite_id');
    }
}
