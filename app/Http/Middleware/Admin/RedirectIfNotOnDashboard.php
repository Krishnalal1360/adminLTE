<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotOnDashboard
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // If authenticated but trying to access any /admin/* route
            // that's NOT dashboard
            if ($request->is('admin/*') && !$request->is('admin/dashboard')) {
                return redirect()->route('admin.dashboard');
            }
        }

        return $next($request);
    }
}



