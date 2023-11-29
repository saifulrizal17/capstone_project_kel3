<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $userRole = (int) Auth::user()->role_id;

            // Cek apakah peran pengguna termasuk dalam peran yang diizinkan
            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }

        // Jika peran pengguna tidak diizinkan, redirect ke halaman landing page
        return redirect('/');
    }
}
