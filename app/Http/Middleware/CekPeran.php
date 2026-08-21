<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekPeran
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check() && in_array(Auth::user()->peran, $roles)) {
            return $next($request);
        }

        abort(403, 'Kamu tidak memiliki akses ke halaman ini.');
    }
}
