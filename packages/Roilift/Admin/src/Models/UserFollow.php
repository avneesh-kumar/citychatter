<?php

namespace Roilift\Admin\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserFollow extends Model
{
    use HasFactory;

    protected $table = 'user_follows';

    protected $fillable = [
        'followed_by',
        'followed_to'
    ];

    public function followedBy()
    {
        return $this->belongsTo(User::class, 'followed_by');
    }

    public function followedTo()
    {
        return $this->belongsTo(User::class, 'followed_to');
    }

}

?>