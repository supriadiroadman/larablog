<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>
        @yield('title')
    </title>

    <!-- Styles -->
    <link href="{{ asset('frontend/css/page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('frontend/img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('frontend/img/favicon.png') }}">
    @stack('styles')
</head>

<body>
    @php
    $setting = App\Models\Setting::first();
    @endphp

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
        <div class="container">

            <div class="navbar-left">
                {{-- <button class="navbar-toggler" type="button">&#9776;</button> --}}
                <a class="navbar-brand" href="{{ route('welcome') }}">
                    <h5 class="logo-dark">{{ $setting->name ?? 'LaraBlog'}}</h5>
                    <h5 class="logo-light text-white">{{ $setting->name ?? 'LaraBlog'}}</h5>
                    {{-- <img class="logo-dark" src="{{ asset('frontend/img/logo-dark.png') }}" alt="logo">
                    <img class="logo-light" src="{{ asset('frontend/img/logo-light.png') }}" alt="logo"> --}}
                </a>
            </div>

            <section class="navbar-mobile">
                <span class="navbar-divider d-mobile-none"></span>

                <ul class="nav nav-navbar">

                </ul>
            </section>

            @auth
            <a class="btn btn-xs btn-round btn-success" href="{{ route('home') }}"
                target="_blank">{{ $setting->menu ?? 'Dashboard' }}</a>
            @else
            <a class="btn btn-xs btn-round btn-success" href="{{ route('login') }}">Login</a>
            @endauth

        </div>
    </nav><!-- /.navbar -->


    @yield('header')

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row gap-y align-items-center">

                <div class="col-6 col-lg-3">
                    <a href="{{ route('welcome') }}">
                        <h5>{{ $setting->name ?? 'LaraBlog'}}</h5>
                        {{-- <img src="{{ asset('frontend/img/logo-dark.png') }}" alt="logo"> --}}
                    </a>
                </div>

                <div class="col-6 col-lg-3 text-right order-lg-last">
                    <div class="social">
                        <a class="social-facebook" href="https://www.facebook.com/thethemeio"><i
                                class="fa fa-facebook"></i></a>
                        <a class="social-twitter" href="https://twitter.com/thethemeio"><i
                                class="fa fa-twitter"></i></a>
                        <a class="social-instagram" href="https://www.instagram.com/thethemeio/"><i
                                class="fa fa-instagram"></i></a>
                        <a class="social-dribbble" href="https://dribbble.com/thethemeio"><i
                                class="fa fa-dribbble"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </footer><!-- /.footer -->


    <!-- Scripts -->
    <script src="{{ asset('frontend/js/page.min.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @include('layouts.partials._sweetalert2')
    @stack('scripts')
</body>

</html>