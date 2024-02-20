<?php

namespace Roilift\Admin\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Roilift\Admin\Models\PostCommentReply;

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

    public function replies()
    {
        return $this->hasMany(PostCommentReply::class);
    }
}


?>