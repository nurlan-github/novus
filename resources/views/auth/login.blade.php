@extends('layouts.app')

@section('pageTitle')
    <x-key-translate key="login" />
@endsection

@section('content')
    <!-- Section - Bootstrap Brain Component -->
    <section class="pb-2 pb-md-3 pb-xl-4 bg-light">
        <div class="container">
            <!-- Flash Message -->
            <x-flash-message />
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8 col-sm-12">
                    <h2 class="mb-3 text-center"><x-key-translate key="login" /></h2>
                    <div class="card shadow bg-white">
                        <div class="card-body">
                            
                            <x-error-alert  class="my-3"/> 

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row p-1 m-0">
                                    <div class="form-group mt-2">
                                        <label for="email" class="form-label"><x-key-translate key="email" /></label>
                                        <input id="email" type="email" class="form-control w-100 " name="email"
                                            value="" required="" autocomplete="email" autofocus="">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="password" class="form-label"><x-key-translate key="password" /></label>
                                        <input id="password" type="password" class="form-control " name="password"
                                            required="" autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="row m-0 align-items-center justify-content-between">
                                        <div class="badge text-warning form-check mt-3 w-50 d-flex align-items-center">
                                            <input class="form-check-input  m-0 mx-1" type="checkbox" name="remember"
                                                id="remember">

                                            <label class="form-check-label text-sm m-0" for="remember">
                                                <x-key-translate key="remember_me" />
                                            </label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a class="badge text-primary mt-3 w-50 " style="text-decoration: none"
                                                href="/password/reset">
                                                <x-key-translate key="forgot_your_password" />
                                            </a>
                                        @endif

                                    </div>


                                    <div class="row m-0">
                                        <div class="col-md-12 m-0 mt-2">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <x-key-translate key="login" />
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
