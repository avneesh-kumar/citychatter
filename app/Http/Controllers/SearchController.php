<?php

namespace App\Http\Controllers;

use App\Models\User;
use Roilift\Admin\Models\Post;
use Roilift\Admin\Models\UserFollow;
use Roilift\Admin\Models\Advertisement;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class SearchController extends Controller
{
    public function __construct(protected ConfigRepositoryInterface $configRepository)
    {
    }
    
    public function index()
    {
        $perPage = $this->configRepository->getConfigValueByKey('postperpage');
        if(!$perPage) {
            $perPage = 15;
        }

        if(auth()->user()) {
            $followers = UserFollow::where('followed_to', auth()->user()->id)->pluck('followed_by')->toArray();
            array_push($followers, auth()->user()->id);
            $latitude = session('latitude');
            $longitude = session('longitude');

            if(auth()->user()->profile->latitude && auth()->user()->profile->longitude) {
                $latitude = auth()->user()->profile->latitude;
                $longitude = auth()->user()->profile->longitude;
            }

            $askedRadius = 1;

            if(request('s_latitude') && request('s_longitude')) {
                $latitude = request('s_latitude');
                $longitude = request('s_longitude');
            }

            if(request('radius')) {
                $askedRadius = request('radius');
            }

            $radius = $askedRadius;

            if($longitude && $latitude) {
                $posts = Post::selectRaw('*')
                    ->selectRaw('(ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) / 1609.344) AS dis',
                                    [$longitude, $latitude])
                    ->havingRaw('dis <= ?', [$radius])
                    ->where(function ($query) {
                        $query->where('title', 'like', '%'.request('search').'%')
                            ->orwhere('content', 'like', '%'.request('search').'%')
                            ->orWhere('location', 'like', '%'.request('search').'%');
                    })
                    ->where('status', true)
                    ->orderBy('dis')
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);

            } else {
                $posts = Post::where('status', true)
                    ->where(function ($query) {
                        $query->where('title', 'like', '%'.request('search').'%')
                            ->orwhere('content', 'like', '%'.request('search').'%')
                            ->orWhere('location', 'like', '%'.request('search').'%');
                    })
                    ->orderBy('updated_at', 'desc')
                    ->paginate($perPage);
            }
        } else {
            if(session()->has('latitude') && session()->has('longitude')) {
                $posts = Post::selectRaw('*, ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) * .000621371192 as distance', [session('longitude'), session('latitude'), request('radius')])
                    ->where('status', true)
                    ->where(function ($query) {
                        $query->where('title', 'like', '%'.request('search').'%')
                            ->orwhere('content', 'like', '%'.request('search').'%')
                            ->orWhere('location', 'like', '%'.request('search').'%');
                    })
                    ->orderBy('distance', 'asc')
                    ->paginate($perPage);
            } else {
                $posts = Post::where('status', true)
                    ->where(function ($query) {
                        $query->where('title', 'like', '%'.request('search').'%')
                            ->orwhere('content', 'like', '%'.request('search').'%')
                            ->orWhere('location', 'like', '%'.request('search').'%');
                    })
                    ->orderBy('updated_at', 'desc')
                    ->paginate($perPage);
            }
        }

        $users = User::leftJoin('user_profiles', 'users.id', '=', 'user_profiles.user_id')
                    ->select('users.*', 'user_profiles.username')
                    ->where(function ($query) {
                        $query->where('users.name', 'like', '%'.request('search').'%')
                            ->orwhere('users.email', 'like', '%'.request('search').'%')
                            ->orWhere('user_profiles.username', 'like', '%'.request('search').'%');
                    })
                    ->paginate($perPage);

        $advertisements = Advertisement::where('status', true)
            ->orderBy('sort_order', 'asc')
            ->paginate($perPage);
        
        $query = request('search');
        return view('search.index', compact('posts', 'users', 'query', 'advertisements'));
    }
}