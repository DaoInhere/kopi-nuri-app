<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user sudah login dan role-nya sesuai dengan yang diminta rute
        if ($request->user() && $request->user()->role === $role) {
            return $next($request);
        }

        // Jika tidak sesuai, tampilkan error 403 Forbidden
        abort(403, 'Akses Ditolak! Ini bukan area Anda.');
    }
}