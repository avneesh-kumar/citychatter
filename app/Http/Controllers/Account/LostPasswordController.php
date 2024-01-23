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

            // create a mail and send it to the user
            Mail::to($user->email)->send(new LostPassword($token));

            return back()->with('success', 'We have e-mailed your password reset link!');
        }

        return back()->withErrors([
            'email' => 'We can\'t find a user with that e-mail address.',
        ]);
    }
}
