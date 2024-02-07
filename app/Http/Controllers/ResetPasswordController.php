<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index($token)
    {
        $user = \App\Models\User::where('token', $token)->first();

        if (!$user) {
            return redirect()->route('home')->with('error', 'Invalid token.');
        }

        return view('reset-password', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:8',
            'new_password_confirm' => 'required|same:new_password',
            'reset_token' => 'required'
        ]);

        $user = \App\Models\User::where('token', request('reset_token'))->first();
        $user->password = bcrypt($request->new_password);
        $user->token = null;
        $user->save();

        return redirect()->route('profile')->with('success', 'Password updated successfully.');
    }
}
