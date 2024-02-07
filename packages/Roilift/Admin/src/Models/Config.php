<?php

namespace Roilift\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group'
    ];
}