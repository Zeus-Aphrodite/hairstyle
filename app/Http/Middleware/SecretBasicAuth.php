<?php namespace App\Http\Middleware;

use Closure;

class SecretBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $usedCredentials = [
            'username' => $request->getUser(),
            'password' => $request->getPassword(),
        ];

        if (config('app.baseHttpAuth') !== $usedCredentials) {
            $header = ['WWW-Authenticate' => 'Basic'];
            return response('You are not authorized to see this page.', 401, $header);
        }

        return $next($request);
    }
}
