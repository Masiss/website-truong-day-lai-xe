<?php

namespace App\Http\Middleware;

use App\Enums\LevelEnum;
use App\Models\Instructor;
use Closure;
use Illuminate\Http\Request;

class InstructorMiddleware
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
        if(!Instructor::isAdmin()){
                return $next($request);
        }

        return redirect()->route('index');
    }
}
