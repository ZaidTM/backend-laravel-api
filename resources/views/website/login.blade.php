@extends('website.includes.master')

@section('title')
Login
@endsection

@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('/') }}">Home</a></li>
                <li>Login</li>
            </ol>

        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mt-4 mt-md-0"></div>

                <div class="col-lg-6 mt-4 mt-md-0">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">@include('website.includes.errors')</div>
                            <div class="col-md-12 form-group mt-3 mt-md-0">
                                <label for=""> Email </label>
                                <input type="email" class="form-control" name="email" id="email"
                                placeholder="Your Email" required>
                            </div>

                            <div class="col-md-12 form-group mt-5 mt-md-0">
                                <br>
                                <label for=""> Password </label>
                                <input type="password" class="form-control" name="password" id="password"
                                placeholder="***********" required>
                            </div>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary p-3">Login</button>
                            </div>

                        </div>

                        <div class="row text-center mt-2">

                            <h6 style="letter-spacing: 2px"><b>Dont have an account <a
                                href="{{ route('register') }}">Create Account</a></b></h6>

                            </div>

                        </form>
                    </div>

                    <div class="col-lg-3 mt-4 mt-md-0"></div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    @endsection
