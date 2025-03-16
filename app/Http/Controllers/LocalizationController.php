<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    public function __invoke(Request $request, $locale)
    {
        $availableLanguages = Language::where('is_active', true)->pluck('code')->toArray();

        if (!in_array($locale, $availableLanguages)) {
            return redirect()->route('page.home');
            // abort(400, 'Invalid language selected');
        }

        session(['locale' => $locale]);
        App::setLocale($locale);

        return redirect()->back();
    }
}
