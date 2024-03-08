<?php

namespace Roilift\Admin\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PostMessage extends Model
{
    protected $fillable = [
        'post_id',
        'from',
        'to',
        'message',
        'seen'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to');
    }

    public function replies()
    {
        return $this->hasMany(PostMessageReply::class);
    }
}

?>