<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Roilift\Admin\Models\UserProfile;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('account.profile.index', compact('user'));
    }

    public function store()
    {
        $user = auth()->user();

        $credentials = request()->validate([
            // 'name' => 'required',
            'username' => 'required|unique:user_profiles,username,' . $user->profile->id,
            // 'gender' => 'nullable',
            'bio' => 'nullable|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg.webp|max:2048',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'location' => 'nullable',
            'show_username' => 'nullable',
            'show_email' => 'nullable',
            'sort_by' => 'nullable',
            'in_radius' => 'nullable',
            'optional_email' => 'nullable',
        ]);

        $user->update($credentials);

        if(request('avatar')) {
            $imageName = time() . '.' . request('avatar')->extension();
            $path = 'images/avatar/' . auth()->user()->id;
            $public_path = public_path($path);

            if(!file_exists($public_path)) {
                mkdir($public_path, 0777, true);
            }

            request('avatar')->move($public_path, $imageName);

            $credentials['avatar'] = $path . '/' . $imageName;
        } else {
            $credentials['avatar'] = $user->profile->avatar;
        }

        if(request('cover')) {
            $imageName = time() . '.' . request('cover')->extension();
            $path = 'images/cover/' . auth()->user()->id;
            $public_path = public_path($path);

            if(!file_exists($public_path)) {
                mkdir($public_path, 0777, true);
            }

            request('cover')->move($public_path, $imageName);

            $credentials['cover'] = $path . '/' . $imageName;
        } else {
            $credentials['cover'] = $user->profile->cover;
        }
        
        $user->profile->update($credentials);

        return redirect()->route('profile');
    }

    public function username()
    {
        $username = request('username');

        $profile = UserProfile::where('username', $username)->first();

        if($profile) {
            return response()->json([
                'status' => 'error',
                'message' => 'Username already taken',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Username available',
        ]);
    }
}
