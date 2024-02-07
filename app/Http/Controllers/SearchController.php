<?php

namespace App\Http\Controllers;

use App\Mail\Registration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Roilift\Admin\Models\Post;
use Illuminate\Support\Facades\Mail;

class SearchController extends Controller
{
    public function index()
    {
        $posts = Post::where('title', 'like', '%'.request('search').'%')
                    ->Orwhere('content', 'like', '%'.request('search').'%')
                    ->where('status', true)
                    ->paginate(10);

                    // put check for location filter
        return view('search.index', compact('posts'));
    }

    public function test()
    {
        die('what are you doing?');
        // Mail::to('dev@avneeshkumar.in')->send(new Registration([]));
    }
}
