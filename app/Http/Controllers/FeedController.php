<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Models\Post;
use Roilift\Admin\Models\Category;
use Illuminate\Support\Facades\Date;
use Roilift\Admin\Models\UserFollow;
use Roilift\Admin\Models\Advertisement;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;
use Roilift\Admin\Interfaces\CategoryRepositoryInterface;

class FeedController extends Controller
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
        protected ConfigRepositoryInterface $configRepository
    )
    {
        
    }

    public function index($slug = null)
    {
        $perPage = $this->configRepository->getConfigValueByKey('postperpage');
        if(!$perPage) {
            $perPage = 15;
        }

        $categories = $this->categoryRepository->all();
        $currentCategory = null;
        $breadcrumbs = [];

        if($slug) {
            $ids = [];
            $currentCategory = Category::where('slug', $slug)->first();

            $ids[] = $currentCategory->id;
            if($currentCategory->children) {
                foreach($currentCategory->children as $child) {
                    $ids[] = $child->id;
                }
            }
            
            if($currentCategory->parent_id) {
                $parent = $currentCategory->parent;

                $breadcrumbs[] = [
                    'name' => $parent->name,
                    'url' => route('feed', $parent->slug)
                ];
            }

            $breadcrumbs[] = [
                'name' => $currentCategory->name,
                'url' => route('feed', $currentCategory->slug)
            ];

            $feeds = Post::where('status', true)
                ->whereIn('category_id', $ids)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

        } else {
            $feeds = Post::where('status', true)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        }

        $advertisements = Advertisement::where('status', true)
            ->orderBy('sort_order', 'asc')
            ->paginate(20);
        
        return view('feed.index2', compact('currentCategory', 'feeds', 'slug', 'breadcrumbs', 'advertisements'));
    }
}
