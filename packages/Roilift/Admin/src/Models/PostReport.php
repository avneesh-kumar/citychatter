<?php

namespace Roilift\Admin\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    protected $fillable = [
        'reason',
        'description',
        'post_id',
        'reported_by'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
}