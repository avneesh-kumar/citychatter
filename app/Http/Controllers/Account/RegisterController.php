<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('account.register.index');
    }

    public function store(Request $request)
    {
        $credentials = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:20|confirmed',
            'password_confirmation' => 'required|min:8|max:20|same:password',
        ]);

        $user = \App\Models\User::create($credentials);

        auth()->login($user);

        return redirect()->route('feed');
    }
}
