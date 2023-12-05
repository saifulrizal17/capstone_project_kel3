@extends('layouts.appauth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center my-5">
                    <img src="{{ asset('/img/logo.png') }}" alt="logo" width="100">
                    <h1>{{ config('app.name') }}</h1>
                </div>
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4">{{ __('Register') }}</h1>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="name">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="password">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="align-items-center d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0 d-flex justify-content-between">
                        <div>
                            <a href="{{ route('login') }}" class="text-primary text-decoration-none"> <- <span
                                    class="text-black">Don't have an account?</span> Login
                            </a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5 text-muted">
                    Copyright &copy; {{ date('Y') }} &mdash; Kelompok 3 Gamelab
                </div>
            </div>
        </div>
    </div>
@endsection
