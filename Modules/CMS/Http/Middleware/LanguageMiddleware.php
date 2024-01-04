<?php

namespace Modules\CMS\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if( !session()->has('_locale')) {
            session()->put('_locale', 'en');
        }
        app()->setLocale(session()->get('_locale'));

        return $next($request);
    }
}
