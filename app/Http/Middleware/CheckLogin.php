<?php

namespace App\Http\Middleware;

use App\Models\Instructor;
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
        if (auth('instructor')->viaRemember() || auth('instructor')->check()) {
            if (Instructor::isAdmin()) {
                return redirect()->route('admin.index');
            } elseif (!Instructor::isAdmin()) {
                return redirect()->route('instructors.index');
            }
        }
        if (auth('driver')->viaRemember() || auth('driver')->check()) {
            return redirect()->route('drivers.index');
        }
        return $next($request);

    }
}
