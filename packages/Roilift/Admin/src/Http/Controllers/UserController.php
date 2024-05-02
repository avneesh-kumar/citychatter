<?php

namespace Roilift\Admin\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Roilift\Admin\Interfaces\UserRepositoryInterface;
use Roilift\Admin\Models\UserFollow;
use Roilift\Admin\Models\UserProfile;

class UserController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function index()
    {
        view()->share('title', 'Users');
        $users = $this->userRepository->paginate(20, ['*'], 'page', null, [], [['field' => 'id', 'dir' => 'desc']]);
        return view('admin::user.index', compact('users'));
    }

    public function create($id=null)
    {
        view()->share('title', 'Create User');
        $backUrl = request()->headers->get('referer');
        return view('admin::user.create', compact('backUrl'));
    }

    public function edit()
    {
        view()->share('title', 'Edit User');
        $user = $this->userRepository->find(request('id'));
        $backUrl = request()->headers->get('referer');
        return view('admin::user.create', compact('user', 'backUrl'));
    }

    public function store()
    {
        $user = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.request('id'),
            'password' => request('id') ? '' : 'required|min:6',
            'username' => 'required|unique:user_profiles,username,'.request('id'),
        ]);
        
        $user['password'] = bcrypt($user['password']);

        if(request('id')) {
            $user = $this->userRepository->update($user, request('id'));
            $userProfile = UserProfile::where('user_id', request('id'))->first();
            $userProfile->username = request('username');
            $userProfile->gender = request('gender');
            $userProfile->save();
        } else {
            $user = $this->userRepository->create($user);
            $userProfile = new UserProfile();
            $userProfile->user_id = $user->id;
            $userProfile->username = request('username');
            $userProfile->gender = request('gender');
            $userProfile->save();
        }

        return redirect()->route('admin.user')->with('success', 'User saved successfully.');
    }

    public function destroy()
    {
        $id = request('id');
        $user = $this->userRepository->find($id);
        if($user) {
            UserProfile::where('user_id', $id)->delete();
            $userFollows = UserFollow::where('followed_by', $id)->get();
            if($userFollows->count() > 0) {
                UserFollow::where('followed_by', $id)->delete();
            }
            $userFollows = UserFollow::where('followed_to', $id)->get();
            if($userFollows->count() > 0) {
                UserFollow::where('followed_to', $id)->delete();
            }
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        }
        return redirect()->back()->withErrors([
            'invalid' => 'User not found.',
        ]);
    }

    public function getUser()
    {
        $keyword = request('q');
        $search['name'] = $keyword;
        $users = $this->userRepository->paginate(20, ['*'], 'page', null, [], [['field' => 'id', 'dir' => 'desc']], $search);
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id,
                'email' => $user->email,
                'text' => $user->name,
            ];
        }

        if(!$data) {
            return response()->json([
                'success' => false,
            ]);
        }
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}


?>