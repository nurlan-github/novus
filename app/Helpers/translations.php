<?php

use App\Models\FrontendKey;

if (!function_exists('translate_key')) {
    function translate_key($key)
    {
        $locale = app()->getLocale(); // Hozirgi tilni olish
        $frontendKey = FrontendKey::where('key', $key)->first();

        if ($frontendKey) {
            $translation = $frontendKey->getTranslation($locale);
            return $translation ? $translation->value : $key; // Tarjima bo'lmasa keyni ko'rsatadi
        } else {
            return $key;
        }
    }
}