<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PSpell\Config;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;
use Roilift\Admin\Models\Post;
use Roilift\Admin\Models\UserFollow;

class HomeController extends Controller
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

        $feeds = Post::where('status', true)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

        // if(auth()->user()) {
        //     // $followers = UserFollow::where('followed_to', auth()->user()->id)->pluck('followed_by')->toArray();
        //     // array_push($followers, auth()->user()->id);
        //     $latitude = session('latitude');
        //     $longitude = session('longitude');

        //     if(auth()->user()->profile->latitude && auth()->user()->profile->longitude) {
        //         $latitude = auth()->user()->profile->latitude;
        //         $longitude = auth()->user()->profile->longitude;
        //     }

            // if($longitude && $latitude) {
            //     $feeds = Post::selectRaw('*')
            //             ->selectRaw('(ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) / 1609.344) AS dis',
            //                             [$longitude, $latitude])
            //             // ->havingRaw('dis <= ?', [$radius])
            //             // ->whereIn('user_id', $followers)
            //             // ->orderBy('dis')
            //             ->orderBy('updated_at', 'desc')
            //             ->paginate($perPage);
            // } else {
            //     $feeds = Post::where('status', true)
            //             ->orderBy('updated_at', 'desc')
            //             ->paginate($perPage);
            // }

            // $feeds = Post::where('status', true)
            //         ->orderBy('updated_at', 'desc')
            //         ->paginate($perPage);

        // } else {
        //     if(session()->has('latitude') && session()->has('longitude')) {
        //         $feeds = Post::selectRaw('*, ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) * .000621371192 as distance', [session('longitude'), session('latitude')])
        //             ->where('status', true)
        //             ->orderBy('updated_at', 'desc')
        //             ->paginate($perPage);
        //     } else {
        //         $feeds = Post::where('status', true)
        //             ->orderBy('updated_at', 'desc')
        //             ->paginate($perPage);
        //     }
        // }
        
        return view('home', compact('feeds'));
    }

    public function currentlocation()
    {
        session(['latitude' => request()->latitude]);
        session(['longitude' => request()->longitude]);

        return response()->json([
            'status' => 'success',
            'message' => 'Location saved successfully'
        ]);
    }
}
