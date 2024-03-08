<?php

namespace App\Http\Controllers;

use App\Mail\Registration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Roilift\Admin\Models\Post;
use Illuminate\Support\Facades\DB;
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

            if(request('latitude') && request('longitude')) {
                $latitude = request('latitude');
                $longitude = request('longitude');
            }

            $radius = ( request('radius') ? request('radius') : auth()->user()->profile->radius );

            $posts = Post::selectRaw('*')
                ->selectRaw('(ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) / 1609.344) AS dis',
                                [$longitude, $latitude])
                ->havingRaw('dis <= ?', [$radius])
                ->where(function ($query) {
                    $query->where('title', 'like', '%'.request('search').'%')
                        ->orwhere('content', 'like', '%'.request('search').'%');
                })
                ->whereIn('user_id', $followers)
                ->orderBy('dis')
                ->paginate($perPage);

            // dd($posts->toRawSql());
            // dd($posts);
                    
        } else {
            if(session()->has('latitude') && session()->has('longitude')) {
                $posts = Post::selectRaw('*, ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) * .000621371192 as distance', [session('longitude'), session('latitude'), request('radius')])
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

        // write laravel query to get the posts based on the search query and the location of the user and the radius of the user




        return view('search.index', compact('posts'));
    }

    public function test()
    {
        die('what are you doing?');
        // Mail::to('dev@avneeshkumar.in')->send(new Registration([]));
    }
}
