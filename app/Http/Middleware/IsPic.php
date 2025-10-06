<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPic
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('pic')) {
            return redirect('/login')->with('error', 'Silakan login sebagai PIC Unit terlebih dahulu.');
        }

        return $next($request);
    }
}
