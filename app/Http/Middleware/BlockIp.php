<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Torann\GeoIP\Facades\GeoIP;
use Symfony\Component\HttpFoundation\Response;

class BlockIp
{
    // use GeoIP;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $location = geoip()->getLocation($request->ip());
        if (strtolower($location->country) === 'india') {
        return abort(403, 'Access Denied - IPs from India are blocked.');
    }
        return $next($request);
    }
}
