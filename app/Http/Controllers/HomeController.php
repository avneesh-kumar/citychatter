<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $feeds = Post::where('status', true)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);
        return view('home', compact('feeds'));
    }

    public function plain()
    {
        return view('plain');
    }
}
