<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {        
        $token = $request->header('X-API-TOKEN');
        $expectedToken = env('API_SECRET_TOKEN');

        if (!$token || $token !== $expectedToken) {
            abort(401, 'Unauthorized: Invalid API token');
        }
        return $next($request);
    }
}
