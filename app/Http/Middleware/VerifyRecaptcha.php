<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class VerifyRecaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        request()->validate([
            'g-recaptcha-response' => 'required',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('GOOGLE_RECAPTCHA_V2_SECRET_KEY'),
            'response' => request('g-recaptcha-response'),
            'remoteip' => request('REMOTE_ADDR'),
        ]);
    
        $recaptchaData = $response->json();
    
        if (!$recaptchaData['success']) {
            return back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed. Please try again.']);
        }

        return $next($request);
    }
}
