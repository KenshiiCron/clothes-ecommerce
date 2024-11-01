<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class OnlyGuestAllowedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentAdmin = Auth::guard('admin')->check();
        if ($currentAdmin) {
            $guard = 'admin';
        } else {
            $guard = 'web';
        }
        if (Auth::guard($guard)->check()) {
            if ($guard === 'admin') {
                return redirect('/admin/dashboard');
            }
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
