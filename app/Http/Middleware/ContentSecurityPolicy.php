<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $csp = "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net; " .
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; " .
            "img-src 'self'; " .
            "font-src 'self' data: https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; " .
            "base-uri 'self'; " .
            "form-action 'self'; " .
            "frame-ancestors 'none';";

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
