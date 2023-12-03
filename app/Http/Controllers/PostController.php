<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Models\Post;
use Roilift\Admin\Models\Category;
use Roilift\Admin\Models\PostLike;
use Roilift\Admin\Models\PostComment;

class PostController extends Controller
{
    public function index($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $like = PostLike::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        return view('post.index', compact('post', 'like'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'location' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $imageName = time() . '.' . request()->image->extension();
        $path = 'images/posts/' . auth()->user()->id;
        $public_path = public_path($path);

        if(!file_exists($public_path)) {
            mkdir($public_path, 0777, true);
        }

        request()->image->move($public_path, $imageName);

        $post = Post::create([
            'title' => request()->title,
            'slug' => request()->slug,
            'content' => request()->content,
            'location' => request()->location,
            'category_id' => request()->category,
            'image' => $path . '/' . $imageName,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('feed');
    }

    public function like()
    {
        PostLike::create([
            'user_id' => auth()->user()->id,
            'post_id' => request()->post_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post liked successfully',
        ]);
    }

    public function unlike()
    {
        PostLike::where('user_id', auth()->user()->id)->where('post_id', request()->post_id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post unliked successfully',
        ]);
    }

    public function comment()
    {
        PostComment::create([
            'user_id' => auth()->user()->id,
            'post_id' => request()->post_id,
            'comment' => request()->comment,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post commented successfully',
        ]);
    }
}
