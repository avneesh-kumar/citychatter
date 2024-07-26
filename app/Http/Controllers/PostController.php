<?php

namespace App\Http\Controllers;

use Stringable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Roilift\Admin\Models\Post;
use Roilift\Admin\Models\Category;
use Roilift\Admin\Models\PostLike;
use Roilift\Admin\Models\PostImage;
use Roilift\Admin\Models\PostComment;
use Roilift\Admin\Models\PostMessage;
use Roilift\Admin\Models\Advertisement;
use Roilift\Admin\Models\PostCommentReply;
use Roilift\Admin\Models\PostMessageReply;
use Roilift\Admin\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    public function index($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if(!$post || !$post->status) {
            return view('errors.404');
        }

        $nextPost = Post::where('id', '>', $post->id)->orderBy('id', 'asc')->first();
        $previousPost = Post::where('id', '<', $post->id)->orderBy('id', 'desc')->first();
        $like = PostLike::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();

        $advertisements = Advertisement::where('status', true)
            ->orderBy('sort_order', 'asc')
            ->paginate(20);
            
        return view('post.index', compact('post', 'like', 'nextPost', 'previousPost', 'advertisements'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->where('parent_id', null)->orderBy('sort_by')->get();
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
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'location' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        $imageName = false;
        if(request()->hasFile('image')) {
            $imageName = time() . '.' . request('image')->extension();
            $path = 'images/posts/' . auth()->user()->id;
            $public_path = public_path($path);

            if(!file_exists($public_path)) {
                mkdir($public_path, 0777, true);
            }

            request()->image->move($public_path, $imageName);
        }

        if(request('id')) {
            $post = Post::where('id', request('id'))->where('user_id', auth()->user()->id)->first();
            if(!$post) {
                return redirect()->route('feed');
            }
            $post->update([
                'title' => request('title'),
                'content' => request('content'),
                'location' => request('location'),
                'latitude' => request('latitude'),
                'longitude' => request('longitude'),
                'category_id' => request('sub_category') ? request('sub_category') : request('category'),
                'image' => $imageName ? $path . '/' . $imageName : $post->image,
                'status' => request('status'),
            ]);

            if(request('old_images')) {
                $this->handleOldImages(request('old_images'));
            }

        } else {
            $post = Post::create([
                'title' => request()->title,
                'slug' => $this->generateSlug(request()->title),
                'content' => request()->content,
                'location' => request()->location,
                'latitude' => request()->latitude,
                'longitude' => request()->longitude,
                'category_id' => request()->sub_category ? request()->sub_category : request()->category,
                'image' => $imageName ? $path . '/' . $imageName : null,
                'user_id' => auth()->user()->id,
                'status' => request()->status ? 1 : 0,
            ]);
        }

        if(request()->hasFile('images')) {
            $this->addImages(request()->images, $post->id);
        }

        return redirect()->route('user.profile', auth()->user()->profile->username);
    }

    private function generateSlug($title)
    {
        $slug = Str::slug($title);
        $post = Post::where('slug', $slug)->first();
        if($post) {
            $slug = $slug . '-' . time();
        }

        return $slug;
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

        return;
    }

    public function handleOldImages($images)
    {
        $oldImages = PostImage::where('post_id', request()->id)->get();
        if($images) {
            foreach($oldImages as $image) {
                if(!in_array($image->id, $images)) {
                    $image->delete();
                }
            }
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
        $post = $this->postRepository->find(request('id'));
        if($post) {
            $postComments = PostComment::where('post_id', $post->id)->get();
            foreach($postComments as $postComment) {
                $postCommentReplies = PostCommentReply::where('post_comment_id', $postComment->id)->get();
                foreach($postCommentReplies as $postCommentReply) {
                    $postCommentReply->delete();
                }
                $postComment->delete();
            }
            PostImage::where('post_id', $post->id)->delete();
            PostLike::where('post_id', $post->id)->delete();
            $postMessages = PostMessage::where('post_id', $post->id)->get();
            foreach($postMessages as $postMessage) {
                $postMessageReplies = PostMessageReply::where('post_message_id', $postMessage->id)->get();
                foreach($postMessageReplies as $postMessageReply) {
                    $postMessageReply->delete();
                }
                $postMessage->delete();
            }

            $post->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully',
        ]);
    }
}
