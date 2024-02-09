<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAuth
{
    public function handle(Request $request, Closure $next)
    {
        $username = env('PARTNER_IN_AUTH_USERNAME');
        $password = env('PARTNER_IN_AUTH_PASSWORD');

        if ($request->getUser() != $username || $request->getPassword() != $password) {
            $headers = ['WWW-Authenticate' => 'Basic'];
            return response('Invalid credentials.', 401, $headers);
        }

        return $next($request);
    }
}
