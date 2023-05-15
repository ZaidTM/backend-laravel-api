<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use jcobhams\NewsApi\NewsApi;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class FilterController extends Controller
{
    public function filternews(Request $request)
    {

        $newsapi = new NewsApi('8bde05cf217d45c8ad2e717f275fff6d');
        $all_articles = $topHeadlines = array();

        if (isset($request->filter) && !empty($request->filter)) {
            $keyword = $request->filter;
        } else {
            $keyword = NULL;
        }

        if (isset($request->source) && !empty($request->source)) {
            $source = $request->source;
        } else {
            $source = NULL;
        }

        if (isset($request->date) && !empty($request->date)) {
            $date = Carbon::parse($request->date)->format("Y-m-d");
        } else {
            $date = NULL;
        }

        if (isset($request->sortBy)) {
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'popularity';
        }
        if (isset($request->page)) {
            $page = $request->page;
        } else {
            $page = 1;
        }
        $pageSize = 25;

        if (isset($request->filter) || isset($request->source) || isset($request->date) || isset($request->category)) {
            try {
                $all_articles = $newsapi->getEverything($keyword, $source, $date, $sortBy, $pageSize, $page);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

//        dd($all_articles);
        return view("website.users.filternews", compact('all_articles', 'request', 'page'));
    }


    public function guardiannews(Request $request)
    {
        $client = new Client();

        $all_articles = $topHeadlines = array();

        $payload = array();
        if (isset($request->filter) && !empty($request->filter)) {
            $payload['q'] = $request->filter;
        } else {
            $payload['q'] = NULL;
        }

        if (isset($request->source) && !empty($request->source)) {
            $payload['source'] = $request->source;
        } else {
            $payload['source'] = NULL;
        }

        if (isset($request->date) && !empty($request->date)) {
            $payload['from-date'] = Carbon::parse($request->date)->format("Y-m-d");
        } else {
            $payload['from-date'] = NULL;
        }

        if (isset($request->sortBy)) {
            $payload['order-by'] = $request->sortBy;
        } else {
            $payload['order-by'] = 'relevance';
        }
        if (isset($request->page)) {
            $payload['page'] = $request->page;
            $page = $request->page;
        } else {
            $payload['page'] = 1;
            $page = 1;
        }
        $payload['page-size'] = 25;
        $payload['api-key'] = "e88f332e-e6b8-4259-aa9c-0f26e5797deb";
        $payload['show-tags'] = "all";

//        dd($payload);


        $response = $client->request('GET', 'https://content.guardianapis.com/search',['query'=>$payload]);

        $page = 1;

        $all_articles = json_decode($response->getBody())->response;

//        dd($body->response->results[0]->fields);

        return view("website.users.guardiannews", compact('all_articles', 'request', 'page'));

    }


    public function bbcnews(Request $request)
    {
        $client = new Client();

        $all_articles = $topHeadlines = array();

        $payload = array();
        if (isset($request->filter) && !empty($request->filter)) {
            $payload['q'] = $request->filter;
        } else {
            $payload['q'] = NULL;
        }

        if (isset($request->source) && !empty($request->source)) {
            $payload['source'] = $request->source;
        } else {
            $payload['source'] = "bbc-news";
        }

        if (isset($request->date) && !empty($request->date)) {
            $payload['from-date'] = Carbon::parse($request->date)->format("Y-m-d");
        } else {
            $payload['from-date'] = NULL;
        }

        if (isset($request->sortBy)) {
            $payload['order-by'] = $request->sortBy;
        } else {
            $payload['order-by'] = 'newest';
        }
        if (isset($request->page)) {
            $payload['page'] = $request->page;
            $page = $request->page;
        } else {
            $payload['page'] = 1;
            $page = 1;
        }
        $payload['page-size'] = 25;
        $payload['api-key'] = "e88f332e-e6b8-4259-aa9c-0f26e5797deb";
        $payload['show-tags'] = "all";
        $payload['country'] = "pk";

//        dd($payload);


        $response = $client->request('GET', 'https://content.guardianapis.com/search',['query'=>$payload]);

        $page = 1;

        $all_articles = json_decode($response->getBody())->response;

//        dd($all_articles);

        return view("website.users.bbcnews", compact('all_articles', 'request', 'page'));

    }


}
