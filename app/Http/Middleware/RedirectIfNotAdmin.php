<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
      if (Auth::user()->access != 1) // e.g. 1 = admin, 0 = normal user in db
        return redirect('/'); // redirect
      return $next($request); // else, allow the request to go through
    }
}
