@extends('website.includes.master')

@section('title')
    Profile
@endsection

@section('content')

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="{{ route('/') }}">Home</a></li>
                    <li>Profile</li>
                </ol>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 mt-4 mt-md-0"></div>

                    <div class="col-lg-6 mt-4 mt-md-0">
                        <form action="{{ route('updateprofile') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">@include('website.includes.errors')</div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <label for=""> Name </label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Your Name" required
                                           value="{{ (Auth::user()->name) ? Auth::user()->name : '' }}">
                                </div>

                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <label for=""> Email </label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="Your Email" required
                                           value="{{ (Auth::user()->email) ? Auth::user()->email : '' }}">
                                </div>

                                <div class="col-md-6 form-group mt-5 mt-md-0">
                                    <br>
                                    <label for=""> Password </label>
                                    <input type="password" min="8" class="form-control" name="password" id="password"
                                           placeholder="*********" autocomplete="off">
                                </div>

                                <div class="col-md-6 form-group mt-5 mt-md-0">
                                    <br>
                                    <label for=""> Phone </label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           placeholder="+92-123456789" required
                                           value="{{ (Auth::user()->phone) ? Auth::user()->phone : '' }}">
                                </div>

                                <div class="col-md-12 form-group mt-5 mt-md-0">
                                    <br>
                                    <label for=""> Address </label>
                                    <textarea name="address" rows="3" placeholder="Address . . . " class="form-control"
                                              required>{{ (Auth::user()->address) ? Auth::user()->address : '' }}</textarea>
                                </div>

                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary p-3">Update</button>
                                </div>

                            </div>

                        </form>
                    </div>

                    <div class="col-lg-3 mt-4 mt-md-0"></div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

@endsection
