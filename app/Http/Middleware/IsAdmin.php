<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('admin')) {
            return redirect('/login')->with('error', 'Silakan login sebagai Admin terlebih dahulu.');
        }

        return $next($request);
    }
}
