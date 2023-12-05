<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Interfaces\CategoryRepositoryInterface;
use Roilift\Admin\Models\Category;
use Roilift\Admin\Models\Post;

class FeedController extends Controller
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    )
    {
        
    }

    public function index($slug = null)
    {
        $categories = $this->categoryRepository->all();

        if($slug) {
            $category = Category::where('slug', $slug)->first();
            $feeds = Post::where('category_id', $category->id)
            ->where('status', true)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);
        } else {
            $feeds = Post::where('status', true)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);
        }

        return view('feed.index2', compact('categories', 'feeds'));
    }
}
