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
        'latitude',
        'longitude',
        'location',
        'sort_by',
        'in_radius',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

?>