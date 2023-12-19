<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link href="{{ asset('/img/logo.png') }}" rel="icon">
    <link href="{{ asset('/img/logo.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    {{-- Aos Animate --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">


    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <header id="header" class="fixed-top ">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-xl-9 d-flex align-items-center justify-content-lg-between">
                    <a href="{{ url('/') }}" class="logo me-auto me-lg-0"><img src="{{ asset('img/logo1.png') }}"
                            alt="" class="img-fluid"></a>

                    <nav id="navbar" class="navbar order-last order-lg-0">
                        <ul>
                            <li><a class="nav-link scrollto" href="#hero">Home</a></li>
                            <li><a class="nav-link scrollto" href="#about">About</a></li>
                            <li><a class="nav-link scrollto" href="#services">Services</a></li>
                            <li><a class="nav-link scrollto" href="#team">Team</a></li>
                            <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                        </ul>
                        <i class="bi bi-list mobile-nav-toggle"></i>
                    </nav><!-- .navbar -->

                    @auth
                        @if (auth()->user()->role_id == 2)
                            <a class="nav-link get-started-btn scrollto" href="{{ route('user.dashboard') }}">Dashboard</a>
                        @elseif(auth()->user()->role_id == 1)
                            <a class="nav-link get-started-btn scrollto"
                                href="{{ route('admin.dashboard') }}">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="nav-link get-started-btn scrollto">Login</a>
                    @endauth
                </div>
            </div>

        </div>
    </header>

    <section id="hero" class="d-flex flex-column justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <h1>Sejahtera.Id - Aplikasi Keuangan Pribadi</h1>
                    <h2>Sejahtera.id adalah aplikasi keuangan pribadi yang membantu Anda mengelola keuangan dengan
                        mudah. Temukan berbagai fitur unggulan dan atur keuangan Anda secara efisien. Nikmati pengalaman
                        berkeuangan yang luar biasa dan dapatkan penawaran eksklusif.
                        <br>
                        <br>
                        <a href="#about" class="hero-btn btn-primary">Get Started</a>
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <main id="main">
        @yield('content')
    </main>

    {{-- <!-- SVG dengan warna #0f0f0f -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" class="svg-divider">
        <path fill="#0f0f0f"
            d="M1260,1.65c-60-5.07-119.82,2.47-179.83,10.13s-120,11.48-180,9.57-120-7.66-180-6.42c-60,1.63-120,11.21-180,16a1129.52,1129.52,0,0,1-180,0c-60-4.78-120-14.36-180-19.14S60,7,30,7H0v93H1440V30.89C1380.07,23.2,1319.93,6.15,1260,1.65Z">
        </path>
    </svg> --}}

    <footer id="footer">
        <div class="container">
            <h3>{{ config('app.name') }}</h3>
            <p>Temukan keindahan dalam setiap langkah. Bersama {{ config('app.name') }}, kami hadir untuk memberikan
                pengalaman yang tak terlupakan. Jelajahi dunia bersama kami!</p>
            <div class="social-links">
                <a href="https://twitter.com/" class="twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://web.facebook.com/" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/" class="instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://github.com/saifulrizal17/capstone_project_kel3.git" class="github"><i class="fab fa-github"></i></a>
                <a href="https://id.linkedin.com/" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="copyright">
                &copy; Copyright &copy; {{ date('Y') }} <a style="color: #007bff"
                    href="">{{ config('app.name') }}</a>.</strong>
                All rights
                reserved.
            </div>
            <div class="credits">
                Designed by Kelompok 3
            </div>
        </div>
    </footer>

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    {{-- Pure Js --}}
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
    <script>
        new PureCounter();
    </script>
    {{-- AOS Animate --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>

    @include('sweetalert::alert')


    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
