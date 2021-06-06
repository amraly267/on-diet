<?php

namespace App\Http\Middleware\Dashboard;

use Closure;
use Illuminate\Http\Request;
use App;

class AdminLocalization
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
        if (session()->has('dashboard-locale')) {
            App::setLocale(session()->get('dashboard-locale'));
        }
        return $next($request);
    }
}
