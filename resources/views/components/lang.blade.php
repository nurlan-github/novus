@php
    $languages = \App\Models\Language::where('is_active', true)->get();
    $currentLang = app()->getLocale();
@endphp

<div class="dropdown mx-2">
    <button class="btn btn-primary" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        {{ strtoupper($currentLang) }}
    </button>
    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
        @foreach ($languages as $language)
            <li>
                <a class="dropdown-item {{ $currentLang == $language->code ? 'active' : '' }}"
                   href="{{ route('lang', $locale = $language->code) }}">
                    {{ $language->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<style>
    .dropdown-toggle {
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .dropdown-item.active {
        background-color: #0d6efd;
        color: #fff !important;
        font-weight: bold;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #000;
    }
</style>
