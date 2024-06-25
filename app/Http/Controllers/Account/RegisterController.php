<?php

namespace App\Http\Controllers\Account;

use App\Mail\UserCreation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class RegisterController extends Controller
{
    public function __construct(protected ConfigRepositoryInterface $configRepository)
    {
    }

    public function index()
    {
        $privacyPolicy = $this->configRepository->getConfigValueByKey('privacypolicy');
        return view('account.register.index', compact('privacyPolicy'));
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

        $userProfile = \Roilift\Admin\Models\UserProfile::create([
            'user_id' => $user->id,
            'username' => $this->createUsername($user->name)
        ]);

        $token = Str::random(64);
        $user->token = $token;
        $user->save();

        Mail::to($user->email)->send(new UserCreation($token));

        return redirect()->route('register')->with('success', 'Registration successful. Please check your email and follow the instructions to activate your account.');
    }

    public function validateEmail($token)
    {
        $user = \App\Models\User::where('token', $token)->first();
        $valid = false;
        if ($user) {
            $user->email_verified_at = now();
            $user->token = null;
            $user->status = true;
            $user->save();
            $valid = true;
        }

        return view('validate-email', compact('valid'));
    }

    private function createUsername($name)
    {
        $name = strtolower(str_replace(' ', '', $name));
        $username = $name . '-' . rand(1000, 9999);
        $userProfile = \Roilift\Admin\Models\UserProfile::where('username', $username)->first();
        if ($userProfile) {
            $this->createUsername($name);
        }
        return $username;
    }
}
