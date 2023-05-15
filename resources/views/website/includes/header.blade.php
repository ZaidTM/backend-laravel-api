<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>FSD | @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{URL::to('website/assets/img/favicon.png')}}" rel="icon">
    <link href="{{URL::to('website/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Krub:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{URL::to('website/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{URL::to('website/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('website/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{URL::to('website/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('website/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('website/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{URL::to('website/assets/css/style.css')}}" rel="stylesheet">

    <style>
        input,select {
            height: 60px;
        }
    </style>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="">FSD</a></h1>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="{{ route('/') }}#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="{{ route('/') }}#about">About</a></li>
                <li><a class="nav-link scrollto" href="{{ route('/') }}#services">Services</a></li>
                <li><a class="nav-link scrollto " href="{{ route('/') }}#portfolio">Portfolio</a></li>
                <li><a class="nav-link scrollto" href="{{ route('/') }}#team">Team</a></li>
                <li><a class="nav-link scrollto" href="{{ route('/') }}#pricing">Pricing</a></li>
                <li><a class="nav-link scrollto" href="{{ route('/') }}#contact">Contact</a></li>
                <li class="dropdown"><a
                        href="#"><span>{{ (Auth::user()) ? Auth::user()->name : 'Dashboard' }}</span>
                        <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @if(Auth::user())
                            <li><a href="{{ route('filternews') }}">News API</a></li>
                            <li><a href="{{ route('guardiannews') }}">Guardian News API</a></li>
                            <li><a href="{{ route('bbcnews') }}">BBC News API</a></li>
                            <li><a href="{{ route('profile') }}">Profile</a></li>
                            <li>
                                <a href="javascript:;" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                                    <span class="link-title">Logout</span>
                                    <form id="logout-form"
                                          action="{{ route('logout') }}"
                                          method="POST"
                                          class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">Signin</a></li>
                            <li><a href="{{ route('register') }}">Signup</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
