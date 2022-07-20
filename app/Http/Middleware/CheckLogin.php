<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
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
        if (Auth::guard('instructor')->viaRemember() || Auth::guard('instructor')->check()) {
            if (Auth::guard('instructor')->user()->level == 0) {
                return redirect()->route('admin.index');
            } elseif (Auth::guard('instructor')->user()->level == 1) {
                return redirect()->route('instructors.index');
            }
        }
        if (Auth::guard('driver')->viaRemember() || Auth::guard('driver')->check()) {
            return redirect()->route('drivers.index');
        }
        return $next($request);

    }
}
