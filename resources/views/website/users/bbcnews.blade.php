@extends('website.includes.master')

@section('title')
    BBC News
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
                    <li>Guardiann News</li>
                </ol>

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">

                <form action="{{ route('bbcnews') }}" id="NewFilterForm" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12">@include('website.includes.errors')</div>
                        <div class="col-lg-4 mt-4 mt-md-0">
                            <label for="">Heading</label>
                            <input type="text" class="form-control" name="filter" id="filter"
                                   placeholder="Filter News"
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
                                    {{ ($request->sortBy && $request->sortBy=="relevance") ? 'selected' : '' }} value="relevance">
                                    Relevance
                                </option>
                                <option
                                    {{ ($request->sortBy && $request->sortBy=="newest") ? 'selected' : '' }} value="newest">
                                    Newest
                                </option>
                                <option
                                    {{ ($request->sortBy && $request->sortBy=="oldest") ? 'oldest' : '' }} value="oldest">
                                    Oldest
                                </option>
                            </select>
                        </div>
                        <div class="col-lg-2 mt-4 mt-md-0">
                            <button type="submit" class="btn btn-primary p-3 mt-4">Filter News</button>
                            <a href="{{ route('bbcnews') }}" type="submit" class="btn btn-danger p-3 mt-4">Reset</a>
                        </div>
                    </div>
                </form>


                <div class="row mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                @if($all_articles)
                                    @php
                                        $totalpage =  $all_articles->pages;
                                    @endphp
                                    <div class="row my-3">
                                        <div class="col-md-4"><h4 style="margin-top:13px"><b>Search Results
                                                    ({{ $all_articles->total }})</b></h4></div>
                                        <div class="col-md-4"><input type="text" onkeyup="myFunction()" id="FIlterNews"
                                                                     class="form-control"
                                                                     placeholder="Search By Heading . . . "></div>
                                        <div class="col-md-4" style="text-align: right !important;">

                                            @if($request->page==1)
                                                <button disabled class="btn btn-dark p-3 text-white">Back</button>
                                            @else
                                                <button onclick="PreviousPage()" class="btn btn-dark p-3 text-white">
                                                    Back
                                                </button>
                                            @endif

                                            @if($request->page < $totalpage+1)
                                                <button onclick="NextPage()" class="btn btn-dark p-3 text-white">Next
                                                </button>
                                            @else
                                                <button disabled class="btn btn-dark p-3 text-white">Next
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    @forelse($all_articles->results as $all_article)
                                        <div class="card cardsearch">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="{{ ($all_article->webUrl) ? $all_article->webUrl : '' }}"
                                                       target="_blank" class="text-dark"><b class="News_Heading">{{ ($all_article->webTitle) ? $all_article->webTitle : '' }}</b>
                                                    </a>
                                                </h5>
                                                <p>
                                                    <b>{{ \Carbon\Carbon::parse($all_article->webPublicationDate)->diffForhumans() }}</b>
                                                </p>
                                                {{--                                                <p class="card-text">{!! Str::Limit($all_article->description,300) !!}</p>--}}
                                                <h6><b>Tags : </b></h6>
                                                @forelse($all_article->tags as $tag)
                                                    <a href="{{ ($tag->webUrl) ? $tag->webUrl : '' }}"
                                                       target="_blank" class="btn btn-primary mb-2">{{ ($tag->webTitle) ? $tag->webTitle : '' }}</a>
                                                @empty
                                                @endforelse
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
