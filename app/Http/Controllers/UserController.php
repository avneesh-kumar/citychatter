<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Models\UserFollow;
use Roilift\Admin\Models\UserProfile;

class UserController extends Controller
{
    public function index()
    {

    }

    public function profile($username)
    {
        $userProfile = UserProfile::where('username', $username)->firstOrFail();
        $userProfile->user->posts = $userProfile->user->posts()->latest()->get();
        $isFollowing = UserFollow::where('followed_by', auth()->user()->id)->where('followed_to', $userProfile->user_id)->first();
        if(auth()->user()->id == $userProfile->user_id) {
            $followers = UserFollow::where('followed_to', $userProfile->user_id)->get();
        } else {
            $followers = UserFollow::where('followed_to', $userProfile->user_id)->where('followed_by', '!=', auth()->user()->id)->get();
        }

        $follows = UserFollow::where('followed_by', $userProfile->user_id)->get()->pluck('followed_to')->toArray();

        return view('user.profile2', compact('userProfile','followers', 'isFollowing', 'follows'));
    }

    public function follow()
    {
        $id = request('id');
        $isFollow = UserFollow::where('followed_by', auth()->user()->id)->where('followed_to', $id)->first();
        if($isFollow) {
            return response()->json([
                'status' => 'error'
            ]);
        }

        $follow = UserFollow::create([
            'followed_by' => auth()->user()->id,
            'followed_to' => $id
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function unfollow()
    {
        $id = request('id');
        $follow = UserFollow::where('followed_by', auth()->user()->id)->where('followed_to', $id)->first();
        $follow->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
