<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminSupportResponse extends Model
{
    protected $table = 'admin_support_responses';
    protected $fillable = [
        'support_id', 'response_detail'
    ];
    public function userResponse()
    {
        return $this->hasOne(UserSupportResponse::class, 'admin_sp_id', 'support_id');
    }
}
