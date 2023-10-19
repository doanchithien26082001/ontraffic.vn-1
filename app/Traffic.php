<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    protected $table = 'traffics';
    protected $fillable = [
        'key_words', 'url_taget', 'url_img', 'traffic_of_date', 'total_buy_traffic', 'time_onsite_id', 'package_price', 'traffic_type_id', 'number_phone', 'user_id', 'url_contain_backlink', 'coin_payment','traffic_status'
    ];
}
