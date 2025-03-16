<?php

namespace App\View\Components;

use App\Models\FrontendKey;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class KeyTranslate extends Component
{
    public $key;
    public $value;

    public function __construct($key)
    {
        $this->key = $key;
        $locale = app()->getLocale(); // Hozirgi til

        $frontendKey = FrontendKey::where('key', $key)->first();

        if ($frontendKey) {
            $translation = $frontendKey->getTranslation($locale);
            $this->value = $translation ? $translation->value : $key; // Tarjima bo'lmasa keyni ko'rsatadi
        } else {
            $this->value = $key;
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.key-translate');
    }
}
