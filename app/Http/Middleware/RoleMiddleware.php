<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Ambil role pengguna yang sedang login
        $userRole = Auth::user()->role;

        // Cek apakah pengguna memiliki salah satu role yang diperbolehkan
        if (!in_array($userRole, $roles)) {
            return redirect()->route('dashboard'); // Redirect ke halaman utama
        }

        return $next($request);
    }
}
