<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckScreenLock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika user sudah login dan screen terkunci
        if (Auth::check() && Session::get('screen_locked', false)) {
            // Kecualikan route lock screen itu sendiri
            if (!$request->routeIs('lockscreen.*')) {
                return redirect()->route('lockscreen.show');
            }
        }

        return $next($request);
    }
}
