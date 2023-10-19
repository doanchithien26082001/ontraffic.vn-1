<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserResponse extends Model
{
    protected $table = 'user_responses';
    protected $fillable = [
        'admin_rp_id', 'responses_detail'
    ];
}
