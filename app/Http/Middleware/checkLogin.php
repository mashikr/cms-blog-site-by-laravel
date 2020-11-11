<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkLogin
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
        if (!session()->has('user_email') || !session()->has('role')) {
            session()->flash('login_warning', 'Please login first!');
            return redirect('login');
        }

        return $next($request);
    }
}
