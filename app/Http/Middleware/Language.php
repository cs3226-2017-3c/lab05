<?php // app/Http/Middleware/Language.php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Language
{
    public function handle($request, Closure $next)
    {
        App::setLocale(Session::has('locale')? Session::get('locale') : Config::get('app.locale'));
        
        return $next($request);
    }
}