<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;
use Illuminate\Support\Facades\App;
class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        $languages = Language::where('is_active', true)->pluck('code')->toArray();
        $defaultLang = Language::where('is_default', true)->first()->code ?? config('app.locale');

        $locale = session('locale', $defaultLang);

        if (!in_array($locale, $languages)) {
            $locale = $defaultLang;
        }

        App::setLocale($locale);
        session(['locale' => $locale]);

        return $next($request);
    }
}
