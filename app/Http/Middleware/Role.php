<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle($request, Closure $next, $type)
    {
     if (Auth::user() &&  Auth::user()->role == $type) {
            return $next($request);
     }
      return redirect('/dashboard');
    }
}
