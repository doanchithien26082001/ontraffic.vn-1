<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelUser extends Model
{
    protected $table = 'levels';
    protected $fillable = [
        'levels_name', 'hook', 'discount'
    ];
}
