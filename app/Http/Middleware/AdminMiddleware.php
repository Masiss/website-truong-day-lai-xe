<?php

namespace App\Http\Middleware;

use App\Enums\LevelEnum;
use App\Models\Instructor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (auth('instructor')->check()) {
            $user = auth('instructor')->user();
            if (Instructor::isAdmin()) {
                return $next($request);
            } elseif (!Instructor::isAdmin()) {
                return redirect()->route('instructors.index');
            }
        }

        return redirect()->route('login');

    }
}
