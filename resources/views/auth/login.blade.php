@extends('layouts.appauth')

@section('addCss')
    <style>
        .card-footer a.text-primary:hover {
            color: #0066cc;
            text-decoration: underline;
        }
    </style>
@endsection

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
                        <h1 class="fs-4 card-title fw-bold mb-4">{{ __('Login') }}</h1>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">{{ __('Password') }}</label>
                                    <a href="{{ route('password.request') }}" class="float-end">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" id="remember" class="form-check-input"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember" class="form-check-label">{{ __('Remember Me') }}</label>
                                </div>
                                <button type="submit" class="btn btn-primary ml-auto">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0 d-flex justify-content-between">
                        <div>
                            <a href="{{ route('frondend') }}" class="text-primary text-decoration-none"> <- Back To
                                    Home</a>
                        </div>
                        <div>
                            <a href="{{ route('register') }}" class="text-primary text-decoration-none">
                                <span class="text-black">Don't have an account?</span> Registrasi ->
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
