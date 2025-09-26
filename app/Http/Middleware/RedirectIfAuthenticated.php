<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string $guard = null)
    {
        switch ($guard) {
            case 'admin':
                if (Auth::guard('admin')->check()) {
                    return redirect()->route('admin.dashboard');
                }
                break;

            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/home');
                }
                break;
        }
        return $next($request);
    }
}
