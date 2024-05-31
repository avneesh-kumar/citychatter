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
        // $latitude = session('latitude');
        // $longitude = session('longitude');

        // if(auth()->user()->profile->latitude && auth()->user()->profile->longitude) {
        //     $latitude = auth()->user()->profile->latitude;
        //     $longitude = auth()->user()->profile->longitude;
        // }

        $categories = $this->categoryRepository->all();

        $breadcrumbs = [];
        // $followers = UserFollow::where('followed_to', auth()->user()->id)->pluck('followed_by')->toArray();
        // array_push($followers, auth()->user()->id);

        if($slug) {
            $ids = [];
            $category = Category::where('slug', $slug)->first();

            $ids[] = $category->id;
            if($category->children) {
                foreach($category->children as $child) {
                    $ids[] = $child->id;
                }
            }
            
            if($category->parent_id) {
                $parent = $category->parent;

                $breadcrumbs[] = [
                    'name' => $parent->name,
                    'url' => route('feed', $parent->slug)
                ];
            }

            $breadcrumbs[] = [
                'name' => $category->name,
                'url' => route('feed', $category->slug)
            ];

            // $feeds = Post::selectRaw('*')
            // ->selectRaw('(ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) / 1609.344) AS dis',
            //                 [$longitude, $latitude])
            // ->whereIn('user_id', $followers)
            // ->where('category_id', $category->id)
            // ->orderBy('updated_at', 'desc')
            // ->paginate($perPage);

            $feeds = Post::where('status', true)
                ->whereIn('category_id', $ids)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

        } else {
            // $feeds = Post::selectRaw('*')
            // ->selectRaw('(ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) / 1609.344) AS dis',
            //                 [$longitude, $latitude])
            // ->whereIn('user_id', $followers)
            // ->orderBy('updated_at', 'desc')
            // ->paginate($perPage);
            $feeds = Post::where('status', true)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        }

        $advertisements = Advertisement::where('status', true)
            ->orderBy('sort_order', 'asc')
            ->paginate(20);
        
        return view('feed.index2', compact('categories', 'feeds', 'slug', 'breadcrumbs', 'advertisements'));
    }
}
