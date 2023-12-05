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
                        <h1 class="fs-4 card-title fw-bold mb-4">{{ __('Reset Password') }}</h1>

                        <form method="POST" action="{{ route('password.email') }}">
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

                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0 d-flex justify-content-between">
                        <div>
                            <a href="{{ route('login') }}" class="text-primary text-decoration-none"> <- <span
                                    class="text-black">Remember your password?</span> Login
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
