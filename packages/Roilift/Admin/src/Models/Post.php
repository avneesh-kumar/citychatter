<?php

namespace Roilift\Admin\Models;

use App\Models\User;
use Roilift\Admin\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'latitute',
        'longitude',
        'location',
        'status',
        'category_id',
        'user_id',
    ];

    public function postLikes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function postComments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}