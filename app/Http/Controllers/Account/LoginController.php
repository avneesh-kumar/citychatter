<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('account.login.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = \App\Models\User::where('email', $credentials['email'])->first();
        
        if ($user && !$user->status) {
            return back()->withErrors([
                'invalid' => 'Your account is not active. Please check your email for the activation link.',
            ]);
        }

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('feed');
        }

        return back()->withErrors([
            'invalid' => 'The provided credentials do not match our records.',
        ]);
    }


}
