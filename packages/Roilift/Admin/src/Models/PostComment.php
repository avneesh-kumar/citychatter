<?php

namespace Roilift\Admin\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{    
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}


?>