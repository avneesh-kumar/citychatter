<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPassword extends Controller
{
    public function index()
    {
        return view('account.reset-password');
    }

    public function store(Request $request)
    {
        request()->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'new_password_confirm' => 'required|same:new_password',
        ]);

        $user = auth()->user();

        if (!\Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->route('account.reset-password')->with('success', 'Password updated successfully.');
    }
}
