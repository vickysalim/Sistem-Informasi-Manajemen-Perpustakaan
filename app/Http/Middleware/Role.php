<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle($request, Closure $next, ...$roles)
    {
      foreach($roles as $role) {
        if (Auth::user() &&  Auth::user()->role == trim($role)) {
          return $next($request);
        }
      }
      
      return redirect('/dashboard');
    }
}
