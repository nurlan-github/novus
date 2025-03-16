@php
    $languages = \App\Models\Language::where('is_active', true)->get();
    $currentLang = app()->getLocale();
@endphp

{{-- <div class="dropdown mx-2">
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
</div> --}}

<ul class="navbar-nav bsb-dropdown-menu-responsive ms-auto align-items-center">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle bsb-dropdown-toggle-caret-disable d-flex align-items-center" href="#"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="position-relative pt-1">
                <i class="bi bi-translate"></i>
                <span class="fw-bold mx-1">{{ strtoupper($currentLang) }}</span>
            </span>
        </a>
        <div class="bg-white dropdown-menu dropdown-menu-md-end bsb-dropdown-sm bsb-dropdown-animation bsb-fadeIn">
            <div class="list-group list-group-flush">
                @foreach ($languages as $language)
                    <a href="{{ route('lang', $locale = $language->code) }}"
                        class="d-flex align-items-center justify-content-start list-group-item list-group-item-action  {{ $currentLang == $language->code ? 'active' : '' }}">
                        <span class="position-relative pt-1">
                            <i class="bi bi-translate"></i>
                            <span class="fw-bold mx-1">{{ $language->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </li>


</ul>
