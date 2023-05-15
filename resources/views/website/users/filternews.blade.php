@extends('website.includes.master')

@section('title')
    Filter News
@endsection

<style>
    .card {
        margin-bottom: 20px;
    }

    .card-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .card-text {
        margin-bottom: 10px;
    }

    .list-group {
        margin-top: 20px;
    }

</style>

@section('content')

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="{{ route('/') }}">Home</a></li>
                    <li>Filter News</li>
                </ol>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">

                <form action="{{ route('filternews') }}" id="NewFilterForm" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12">@include('website.includes.errors')</div>
                        <div class="col-lg-4 mt-4 mt-md-0">
                            <label for="">Heading</label>
                            <input type="text" class="form-control" name="filter" id="filter"
                                   placeholder="Filter News" required
                                   value="{{ ($request->filter) ? $request->filter : '' }}">
                        </div>
                        <div class="col-lg-2 mt-4 mt-md-0">
                            <label for="">Date</label>
                            <input type="date" name="date" class="form-control" placeholder="Date"
                                   value="{{ ($request->date) ? $request->date : '' }}">
                        </div>
                        <div class="col-lg-2 mt-4 mt-md-0">
                            <label for="">Source</label>
                            <input type="text" name="source" class="form-control" placeholder="Source"
                                   value="{{ ($request->source) ? $request->source : '' }}">
                            <input type="hidden" name="page" id="page"
                                   value="{{ ($request->page) ? $request->page : 1 }}">
                        </div>
                        <div class="col-lg-2 mt-4 mt-md-0">
                            <label for="">Sort By</label>
                            <select name="sortBy" class="form-control">
                                <option
                                    {{ ($request->sortBy && $request->sortBy=="popularity") ? 'selected' : '' }} value="popularity">
                                    Popularity
                                </option>
                                <option
                                    {{ ($request->sortBy && $request->sortBy=="publishedAt") ? 'selected' : '' }} value="publishedAt">
                                    Date
                                </option>
                                <option
                                    {{ ($request->sortBy && $request->sortBy=="relevancy") ? 'selected' : '' }} value="relevancy">
                                    Relevancy
                                </option>
                            </select>
                        </div>
                        <div class="col-lg-2 mt-4 mt-md-0">
                            <button type="submit" class="btn btn-primary p-3 mt-4">Filter News</button>
                            <a href="{{ route('filternews') }}" type="submit" class="btn btn-danger p-3 mt-4">Reset</a>
                        </div>
                    </div>
                </form>


                <div class="row mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                @if($all_articles)
                                    @php
                                        $totalpage =  (int)($all_articles->totalResults/25);
                                    @endphp
                                    <div class="row my-3">
                                        <div class="col-md-4"><h4 style="margin-top:13px"><b>Search Results
                                                    ({{ $all_articles->totalResults }})</b></h4></div>
                                        <div class="col-md-4"><input type="text" onkeyup="myFunction()" id="FIlterNews"
                                                                     class="form-control"
                                                                     placeholder="Search By Heading . . . "></div>
                                        <div class="col-md-4" style="text-align: right !important;">

                                            @if($page==1)
                                                <button disabled class="btn btn-dark p-3 text-white">Back</button>
                                            @else
                                                <button onclick="PreviousPage()" class="btn btn-dark p-3 text-white">
                                                    Back
                                                </button>
                                            @endif

                                            @if($page < $totalpage+1)
                                                <button onclick="NextPage()" class="btn btn-dark p-3 text-white">Next
                                                </button>
                                            @else
                                                <button disabled class="btn btn-dark p-3 text-white">Next
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    @forelse($all_articles->articles as $all_article)

                                        <div class="card cardsearch">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <b class="News_Heading">{{ ($all_article->title) ? $all_article->title : '' }}</b>
                                                </h5>
                                                <p>
                                                    <b>{{ \Carbon\Carbon::parse($all_article->publishedAt)->diffForhumans() }}</b>
                                                </p>
                                                <p class="card-text">{!! Str::Limit($all_article->description,300) !!}</p>
                                                <a href="{{ ($all_article->url) ? $all_article->url : '' }}"
                                                   target="_blank" class="btn btn-primary">Read more</a>
                                            </div>
                                        </div>

                                    @empty
                                    @endforelse
                                @else
                                    <h4><b>Please Search Something . . . </b></h4>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </section>

    </main><!-- End #main -->

@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
    function myFunction() {
        var input, filter, cards, cardContainer, title, i;
        input = document.getElementById("FIlterNews");
        filter = input.value.toUpperCase();
        cards = document.getElementsByClassName("cardsearch");
        for (i = 0; i < cards.length; i++) {
            title = cards[i].querySelector(".News_Heading");
            if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }

    function NextPage() {
        var currentpage = $("#page").val();
        var nextpage = parseInt(currentpage) + 1;
        $("#page").val(nextpage);
        $("#NewFilterForm").submit();
    }

    function PreviousPage() {
        var currentpage = $("#page").val();
        if (parseInt(currentpage) > 1) {
            var previouspage = parseInt(currentpage) - 1;
            $("#page").val(previouspage);
            $("#NewFilterForm").submit();
        } else {
            var previouspage = 1;
            $("#page").val(previouspage);
            $("#NewFilterForm").submit();
        }
    }

</script>
