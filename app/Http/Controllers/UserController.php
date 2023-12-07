<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Models\UserProfile;

class UserController extends Controller
{
    public function index()
    {

    }

    public function profile($username)
    {
        $userProfile = UserProfile::where('username', $username)->firstOrFail();
        return view('user.profile', compact('userProfile'));
    }
}
