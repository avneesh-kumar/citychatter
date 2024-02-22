<?php

namespace App\Http\Controllers;

use App\Mail\Registration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Roilift\Admin\Models\Post;
use Illuminate\Support\Facades\Mail;
use Roilift\Admin\Models\UserFollow;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class SearchController extends Controller
{
    public function __construct(protected ConfigRepositoryInterface $configRepository)
    {
    }
    
    public function index()
    {
        // $posts = Post::where('title', 'like', '%'.request('search').'%')
        //             ->Orwhere('content', 'like', '%'.request('search').'%')
        //             ->where('status', true)
        //             ->paginate(10);

        $perPage = $this->configRepository->getConfigValueByKey('postperpage');
        if(!$perPage) {
            $perPage = 15;
        }

        if(auth()->user()) {
            $followers = UserFollow::where('followed_to', auth()->user()->id)->pluck('followed_by')->toArray();
            $latitude = session('latitude');
            $longitude = session('longitude');

            if(auth()->user()->profile->latitude && auth()->user()->profile->longitude) {
                $latitude = auth()->user()->profile->latitude;
                $longitude = auth()->user()->profile->longitude;
            }

            $posts = Post::selectRaw('*, ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) * .000621371192 as distance', [$latitude, $longitude])
                    ->where('status', true)
                    ->where('title', 'like', '%'.request('search').'%')
                    ->Orwhere('content', 'like', '%'.request('search').'%')
                    ->whereIn('user_id', $followers)
                    ->orderBy('distance', 'asc')
                    ->paginate($perPage);
            
            // dd($posts);
        } else {
            if(session()->has('latitude') && session()->has('longitude')) {
                $posts = Post::selectRaw('*, ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) * .000621371192 as distance', [session('longitude'), session('latitude')])
                    ->where('status', true)
                    ->where('title', 'like', '%'.request('search').'%')
                    ->Orwhere('content', 'like', '%'.request('search').'%')
                    ->orderBy('distance', 'asc')
                    ->paginate($perPage);
            } else {
                $posts = Post::where('status', true)
                    ->where('title', 'like', '%'.request('search').'%')
                    ->Orwhere('content', 'like', '%'.request('search').'%')
                    ->orderBy('updated_at', 'desc')
                    ->paginate(15);
            }
        }

        return view('search.index', compact('posts'));
    }

    public function test()
    {
        die('what are you doing?');
        // Mail::to('dev@avneeshkumar.in')->send(new Registration([]));
    }
}
