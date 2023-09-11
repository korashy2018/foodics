<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $code = $request->segment(3);

        $availableLocales = config("translatable.locales");
        $languageCode = strtolower($code);

        if (!in_array($languageCode, $availableLocales)) {
            $languageCode = 'en';
        }
        LaravelLocalization::setLocale($languageCode);
//        $request->route()->forgetParameter('lang');
        return $next($request);

    }
}
