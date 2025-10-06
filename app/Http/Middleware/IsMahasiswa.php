<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsMahasiswa
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('mahasiswa')) {
            return redirect('/login')->with('error', 'Silakan login sebagai Mahasiswa terlebih dahulu.');
        }

        return $next($request);
    }
}
