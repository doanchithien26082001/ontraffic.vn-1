<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportImage extends Model
{
    protected $table = 'support_imgs';
    protected $fillable = [
        'support_id', 'url_img',
    ];
}
