<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QrPayment extends Model
{
    protected $table = 'qr_payments';
    protected $fillable = [
        'qr_img', 'user_id','bank_acount_id'
    ];
}
