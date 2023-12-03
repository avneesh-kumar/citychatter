<?php

namespace Roilift\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Roilift\Admin\Interfaces\PostRepositoryInterface;
use Roilift\Admin\Interfaces\CategoryRepositoryInterface;

class PostController extends Controller
{
    public function __construct(
        protected PostRepositoryInterface $postRepository,
        protected CategoryRepositoryInterface $categoryRepository,
    ) {
    }

    public function index()
    {
        view()->share('title', 'Post');
        $search = [];
        if(request('title')) {
            $search['title'] = request('title');
        }

        if(request()->has('status')) {
            $search['status'] = request('status');
        }
        
        $posts = $this->postRepository->paginate(20, ['*'], 'page', null, [], [['field' => 'id', 'dir' => 'desc']], $search);
        return view('admin::post.index', compact('posts'));
    }

    public function create()
    {
        view()->share('title', 'Create Post');
        $categories = $this->categoryRepository->all();
        $backUrl = request()->headers->get('referer');

        return view('admin::post.create', compact('categories', 'backUrl'));
    }

    public function edit($id)
    {
        view()->share('title', 'Edit Post');
        $post = $this->postRepository->find($id);
        $categories = $this->categoryRepository->all();
        return view('admin::post.create', compact('post', 'categories', 'users'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . request('id'),
            'content' => 'nullable',
            'status' => 'required'
        ]);
        
        $this->postRepository->create($request->all());
        return redirect()->route('admin.post');
    }

    public function destroy($id)
    {
        $this->postRepository->destroy($id);
        return redirect()->route('admin.post');
    }
}

?>