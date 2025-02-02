<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;



class KaryawanMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'karyawan') {
            return $next($request);
        }

        abort(403, 'Akses ditolak'); // Jika bukan karyawan, tampilkan error 403
    }
}
