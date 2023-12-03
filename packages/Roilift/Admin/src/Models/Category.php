<?php

namespace Roilift\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function publicPosts()
    {
        return $this->hasMany(Post::class)->where('status', 1);
    }

    public function privatePosts()
    {
        return $this->hasMany(Post::class)->where('status', 0);
    }
}

?>