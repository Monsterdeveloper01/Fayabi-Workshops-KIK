<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
    // Cek apakah user sudah login & role-nya sesuai dengan yang diminta
    if ($request->user()->role !== $role) {
        // Kalau role tidak cocok, tendang ke halaman dashboard biasa atau tampilkan error
        abort(403, 'MAAF, ANDA TIDAK PUNYA AKSES KE HALAMAN INI.');
    }

    return $next($request);
    }
}
