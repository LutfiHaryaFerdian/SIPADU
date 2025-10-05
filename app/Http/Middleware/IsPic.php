<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// Tambahkan import Auth
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsPic
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ganti pengecekan session dengan Auth::guard()->check()
        if (!Auth::guard('pic')->check()) {
            return redirect('/login')->with('error', 'Silakan login sebagai PIC Unit terlebih dahulu.');
        }

        return $next($request);
    }
}
