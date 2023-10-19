<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAcount extends Model
{
    protected $table = 'bank_acounts';
    protected $fillable = [
        'bank_id', 'bank_name', 'acount_name',
    ];
}
