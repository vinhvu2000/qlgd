<?php

namespace App\Http\Middleware;

use Attribute;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && ((Auth::user()->role == 'admin') || (Auth::user()->role == 'superadmin'))) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}