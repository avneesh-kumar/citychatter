<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class ContactController extends Controller
{
    public function __construct(protected ConfigRepositoryInterface $configRepository)
    {    
    }

    public function index()
    {
        $address = $this->configRepository->getConfigValueByKey('address');
        $phone = $this->configRepository->getConfigValueByKey('phone');
        $email = $this->configRepository->getConfigValueByKey('email');
        return view('other.contact', compact('address', 'phone', 'email'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:25',
        ]);

        $mailTo = $this->configRepository->getConfigValueByKey('email');
        
        if($mailTo) {
            Mail::to($mailTo)->send(new ContactUs($data));
        }

        return redirect()->back()->with('message', 'Thanks for your message. We will be in touch.');
    }
}
