<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSupportResponse extends Model
{
    protected $table = 'user_support_responses';
    protected $fillable = [
        'admin_sp_id', 'response_detail'
    ];
}
