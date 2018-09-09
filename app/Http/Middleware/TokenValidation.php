<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper\Guzzle;
use App\Helper\AuthTracker;
class TokenValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $param = [
            'method' => 'GET',
            'url' => 'check-token',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ]
            ]
        ];
        $response = Guzzle::request($param);

        if ($response['response'] == 'failed') {
            return redirect('login');
        } else {
            return $next($request);
        }
    }
}
