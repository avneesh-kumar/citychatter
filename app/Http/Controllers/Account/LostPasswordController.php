<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use App\Mail\LostPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class LostPasswordController extends Controller
{
    public function index()
    {
        return view('account.lost-password');
    }

    public function email(Request $request)
    {
        $email = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $email)->first();

        if ($user) {
            $token = Str::random(64);
            $user->token = $token;
            $user->save();

            Mail::to($user->email)->send(new LostPassword($token));

            return back()->with('success', 'Please check your e-mail for the password reset link.');
        }

        return back()->withErrors([
            'email' => 'We can\'t find a user with this e-mail.',
        ]);
    }
}
