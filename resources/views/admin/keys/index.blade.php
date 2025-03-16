@extends('layouts.app')

@section('model')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-speedometer2 me-2"></i>
            <x-key-translate key="dashboard" />
        </a>
    </li>
@endsection

@section('pageTitle')
    <x-key-translate key="keys_translate"/>
@endsection

@section('content')
    @php
        use App\Models\Language;
    @endphp
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-6 col-sm-12 d-flex align-items-center">
                <h3 class="fw-bold">@yield('pageTitle')</h3>
            </div>
            <div class="col-lg-6 col-sm-12 d-flex justify-content-end">
                @can('create_keys_translate')
                    <a href="{{ route('keys.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>
                        <x-key-translate key="create"/>
                    </a>
                @endcan
            </div>
        </div>
        <!-- Flash Message -->
        <x-flash-message />
        <div class="table-responsive mt-3">
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th><x-key-translate key="keys"/></th>
                        @foreach (Language::where('is_active', true)->get() as $lang)
                            <th>{{ $lang->name . " - " . strtoupper($lang->code) }}</th>
                        @endforeach
                        <th><x-key-translate key="actions"/></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keys as $key)
                        <tr>
                            <td><span class="badge text-bg-primary">{{ $key->key }}</span></td>
                            @foreach (Language::where('is_active', true)->get() as $lang)
                                <td>
                                    {{ $key->translations->where('language_id', $lang->id)->first()->value ?? 'N/A' }}
                                </td>
                            @endforeach
                            <td class="text-center">
                                <a href="{{ route('keys.edit', $key->id) }}" class="btn btn-sm btn-warning" style="width: 100px">
                                    <i class="bi bi-pencil-square"></i>
                                    <x-key-translate key="edit"/>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
