<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

    }

    public function profile()
    {
        $feeds = auth()->user()->posts()->orderBy('created_at', 'desc')->get();

        return view('user.profile', compact('feeds'));
    }
}
