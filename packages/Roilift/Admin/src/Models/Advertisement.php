<?php

namespace Roilift\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'image',
        'url',
        'sort_order',
        'status',
        'created_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}