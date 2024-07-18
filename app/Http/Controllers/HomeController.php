<?php

namespace App\Http\Controllers;

use PSpell\Config;
use Illuminate\Http\Request;
use Roilift\Admin\Models\Post;
use Roilift\Admin\Models\UserFollow;
use Roilift\Admin\Models\Advertisement;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

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
                
        $advertisements = Advertisement::where('status', true)
            ->orderBy('sort_order', 'asc')
            ->paginate(20);
        
        return view('home', compact('feeds', 'advertisements'));
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
