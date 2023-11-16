<?php

namespace Roilift\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        view()->share('title', 'Login');
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
}


?>