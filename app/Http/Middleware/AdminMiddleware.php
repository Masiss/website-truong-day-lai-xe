<?php

namespace App\Http\Middleware;

use App\Enums\LevelEnum;
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
        if (Auth::guard('instructor')->check()) {
            $user = Auth::guard('instructor')->user();
            if ($user->level == LevelEnum::ADMIN->value) {
                return $next($request);
            } elseif ($user->level == LevelEnum::INSTRUCTOR->value) {
                return redirect()->route('instructors.index');
            }
        }

        return redirect()->route('login');

    }
}
