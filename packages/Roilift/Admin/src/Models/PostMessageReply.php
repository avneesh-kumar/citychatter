<?php

namespace Roilift\Admin\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PostMessageReply extends Model
{
    protected $fillable = [
        'post_message_id',
        'post_id',
        'from',
        'to',
        'comment',
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

    public function message()
    {
        return $this->belongsTo(PostMessage::class);
    }

}