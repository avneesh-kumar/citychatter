<?php

namespace Roilift\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Roilift\Admin\Interfaces\AdminRepositoryInterface;

class AccountController extends Controller
{
    public function __construct(protected AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        view()->share('title', 'Account Information');
        $backUrl = request()->headers->get('referer');
        return view('admin::account.index', compact('backUrl'));
    }

    public function store()
    {
        // dd(request()->all());
        $account = request()->validate([
            'name' => 'required',
            'password' => 'nullable|confirmed|min:8',
            'password_confirmation' => 'nullable|min:8|same:password',
        ]);

        if(request()->password == null) {
            $account['password'] = auth()->guard('admin')->user()->password;
        } else {
            $account['password'] = bcrypt(request()->password);
        }

        $this->adminRepository->update($account, auth()->guard('admin')->user()->id);

        return redirect()->back()->with('success', 'Account updated successfully');
    }
}