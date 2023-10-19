<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminResponse extends Model
{
    protected $table = 'admin_responses';
    protected $fillable = [
        'support_id', 'response_detail'
    ];
    public function userResponse()
    {
        return $this->hasOne(UserResponse::class, 'admin_rp_id', 'support_id');
    }
}
