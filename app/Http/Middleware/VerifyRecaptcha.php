<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
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
        return $next($request);
        $recaptchaSecret = env('GOOGLE_RECAPTCHA_SECRET_KEY');
        $recaptchaResponse = $request->input('g-recaptcha-response');

        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => $recaptchaSecret,
                'response' => $recaptchaResponse,
            ]
        ]);

        $body = json_decode((string) $response->getBody());
        
        if (!$body->success || $body->score < 0.5) {
            return redirect()->back()->withErrors(['error' => 'Captcha verification failed.']);
        }

        return $next($request);
    }
}
