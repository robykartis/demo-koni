<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsCabor
{
    public function handle($request, Closure $next)

    {

        if (auth()->user()->is_admin == 2) {
            return $next($request);
        }

        return redirect('home')->with('error', "You don't have admin access.");
    }
}
