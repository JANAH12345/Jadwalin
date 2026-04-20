<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MarketingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Cek apakah user login dan memiliki role marketing
        if (!Auth::check() || ($user && $user->role !== 'marketing')) {
            return redirect()->route('login')->with('error', 'Silakan masuk dengan akun Marketing.');
        }

        return $next($request);
    }
}
