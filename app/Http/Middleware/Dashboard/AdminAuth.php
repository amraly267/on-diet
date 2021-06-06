<?php

namespace App\Http\Middleware\Dashboard;

use Illuminate\Support\Facades\Redirect;
use Auth;
use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;
use View;
use Spatie\Permission\Models\Role;

class AdminAuth
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check())
        {
            return redirect()->route('admin-login');
        }

        $settings = Setting::find(1);
        View::share('title', $settings->project_name);
        View::share('logo', $settings->logo ? $settings->logo_path : asset('img/dashboard/logo.svg'));

        if($settings->favicon)
        {
            View::share('favicon', $settings->favicon_path);
        }
        else
        {
            if($settings->logo)
            {
                View::share('favicon', $settings->logo_path);
            }
            else
            {
                View::share('favicon', asset('img/dashboard/logo.svg'));
            }
        }

        if(is_null($settings->logo))
        {
            View::share('logo', asset('img/dashboard/logo.svg'));
        }
        else
        {
            View::share('logo', $settings->logo_path);
        }

        $roles = Role::all();
        View::share('roles', $roles);

        return $next($request);
    }
}
