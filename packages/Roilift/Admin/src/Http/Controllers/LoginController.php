<?php

namespace Roilift\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        view()->share('title', 'Login');
        return view('admin::user.login');
    }

    public function login()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // dd($credentials);
        if (auth()->guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.category');
        }

        return redirect()->back()->withErrors([
            'invalid' => 'Email or password is incorrect.',
        ]);
    }
}

?>