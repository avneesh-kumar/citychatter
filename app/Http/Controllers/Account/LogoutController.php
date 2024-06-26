<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
