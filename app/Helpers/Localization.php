<?php
namespace App\Helpers;

use App\Models\Language;
use App\Models\Translation;

class Localization
{
    public static function getTranslation($key)
    {
        $language = app()->getLocale(); // Joriy tilni olish (masalan, 'uz', 'ru', 'en')
        $language_id = Language::where('code', $language)->first()->id;

        $translation = Translation::where('key', $key)
            ->where('language_id', $language_id)
            ->first();

        return $translation ? $translation->translation : $key;
    }
}