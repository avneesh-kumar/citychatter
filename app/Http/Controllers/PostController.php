<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Models\Post;
use Roilift\Admin\Models\Category;
use Roilift\Admin\Models\PostLike;
use Roilift\Admin\Models\PostImage;
use Roilift\Admin\Models\PostComment;
use Roilift\Admin\Models\PostCommentReply;

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
        $categories = Category::all()->where('status', 1)->where('parent_id', null);
        if(request()->id) {
            $post = Post::where('id', request()->id)->where('user_id', auth()->user()->id)->get()->first();
            if(!$post) {
                return redirect()->route('feed');
            }
            return view('post.create', compact('categories', 'post'));
        }
        return view('post.create', compact('categories'));
    }

    public function store()
    {
        // dd(request()->all());
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'location' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'latitude' => request()->latitude,
            'longitude' => request()->longitude,
            'category_id' => request()->sub_category ? request()->sub_category : request()->category,
            'image' => $path . '/' . $imageName,
            'user_id' => auth()->user()->id,
        ]);

        if(request()->hasFile('images')) {
            $this->addImages(request()->images, $post->id);
        }

        return redirect()->route('feed');
    }

    public function addImages($images, $postId)
    {
        $path = 'images/posts/' . auth()->user()->id . '/' . $postId;
        $public_path = public_path($path);

        if(!file_exists($public_path)) {
            mkdir($public_path, 0777, true);
        }

        foreach($images as $image) {
            $imageName = $image->getClientOriginalName() . time() . '.' . $image->extension();
            $image->move($public_path, $imageName);
            
            PostImage::create([
                'post_id' => $postId,
                'image' => $path . '/' . $imageName,
            ]);
        }

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

    public function commentReply()
    {
        if(request('reply') == '') {
            return response()->json([
                'success' => false,
                'message' => 'Reply cannot be empty',
            ]);
        }

        $PostCommentReply = PostCommentReply::create([
            'user_id' => auth()->user()->id,
            'post_comment_id' => request('post_comment_id'),
            'reply' => request('reply'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment replied successfully',
            'data' => $PostCommentReply,
        ]);
    }

    public function delete()
    {
        $postId = request('id');
        PostComment::where('post_id', $postId)->delete();
        PostImage::where('post_id', $postId)->delete();

        // need to add post_id field and then delete all the replies of that post
        // PostCommentReply::where('post_id', $postId)->delete();

        Post::where('id', request('id'))->where('user_id', auth()->user()->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully',
        ]);
    }
}
