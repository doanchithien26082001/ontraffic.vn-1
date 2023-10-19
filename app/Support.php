<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'supports';
    protected $fillable = [
        'name', 'id_support', 'support_title', 'support_detail', 'status', 'sp_type_id', 'user_id'
    ];
    function supportType()
    {
        return $this->belongsTo(SupportType::class, 'sp_type_id');
    }
    function getSupportImgs()
    {
        return $this->hasMany(SupportImage::class,'support_id', 'id_support');
    }
    function getAdminSupportResponses()
    {
        return $this->hasMany(AdminSupportResponse::class,'support_id', 'id_support');
    }
}
