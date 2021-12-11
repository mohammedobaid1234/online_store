<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
       $locale = session()->put('lang', App::currentLocale());
        $locale = $request->query('lang', session('lang'));
        if (! in_array($locale, ['en', 'ar'])) {
            abort(500);
        }
        if($locale){
            App::setLocale($locale);
            session()->put('lang', $locale);
        }
        return $next($request);
    }
}
