<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckNurseType
{
    public function handle(Request $request, Closure $next, $type): Response
    {
        if (Auth::guard('nurse')->check() && Auth::guard('nurse')->user()->type == $type) {
            return $next($request);
        }

        return redirect()->route('login')->withErrors(['access_denied' => 'You do not have access to this area.']);
    }
}
