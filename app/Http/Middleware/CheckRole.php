<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Pastikan user login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil role user
        $userRole = Auth::user()->role ?? 'guest';

        // Cek apakah role cocok
        if (!in_array($userRole, $roles)) {
            return redirect()->route('home')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}
