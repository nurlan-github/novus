@extends('layouts.app')

@section('pageTitle')
    <x-key-translate key="register" />
@endsection

@section('content')
    <section class="pb-2 pb-md-3 pb-xl-4 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8 col-sm-12">
                    <h2 class="mb-3 text-center"><x-key-translate key="register" /></h2>
                    <div class="card shadow bg-white py-3">
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row p-1 m-0">
                                    <div class="form-group mt-2">
                                        <label for="name" class="form-label"><x-key-translate key="full_name" /></label>
                                        <input id="name" type="text" class="form-control " name="name"
                                            value="" required="" autocomplete="name" autofocus="">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="email" class="form-label"><x-key-translate key="email" /></label>
                                        <input id="email" type="email" class="form-control " name="email"
                                            value="" required="" autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="password" class="form-label"><x-key-translate key="password" /></label>
                                        <input id="password" type="password" class="form-control " name="password"
                                            required="" autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="password-confirm" class="form-label"><x-key-translate key="confirm_password" /></label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required="" autocomplete="new-password">
                                    </div>

                                    <div class="row m-0">
                                        <div class="col-md-12 m-0 mt-2">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <x-key-translate key="register" />
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
