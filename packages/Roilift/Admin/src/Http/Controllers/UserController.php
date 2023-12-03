<?php

namespace Roilift\Admin\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Roilift\Admin\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function index()
    {
        view()->share('title', 'Login');
        $users = $this->userRepository->all();
        return view('admin::user.login');
    }

    public function register()
    {
        view()->share('title', 'Register');
        return view('admin::user.register');
    }

    public function store()
    {
        $credentials = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required'
        ]);

        $credentials['password'] = bcrypt($credentials['password']);

        if (auth()->guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.category');
        }

        return redirect()->back()->withErrors([
            'invalid' => 'Email or password is incorrect.',
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