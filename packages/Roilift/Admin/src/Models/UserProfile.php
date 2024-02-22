<?php

namespace Roilift\Admin\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'username',
        'gender',
        'bio',
        'avatar',
        'cover',
        'latitude',
        'longitude',
        'location',
        'show_username',
        'show_email',
        'sort_by',
        'in_radius',
        'optional_email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

?>