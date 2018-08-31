<?php

use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/locations/{location}/lenders/{lender}', function () {
    $client = new Client([
        'base_uri' => 'https://mortgageapi.zillow.com',
    ]);

    $json = [
        "sort" => "Relevance",
        "pageSize" => 2000,
        "page" => 1,
        "fields" => ["companyName","totalReviews","rating","screenName","imageId","individualName","employerScreenName","nmlsId","recentReviews","confirmedReviews"],
    ];

    if (!is_null(request("location"))) {
        $json["location"] = request("location");
    }

    if (!is_null(request("lender"))) {
        $json["lenderName"] = request("lender");
    }


    $response = $client->request('POST', '/getLenderDirectoryListings?partnerId=RD-JGLGMSG', [
        "json" => $json,
        "headers" => [
            "Origin" => "https://www.trulia.com",
            "Accept" => "application/json, text/javascript, */*; q=0.01",
            "X-DevTools-Emulate-Network-Conditions-Client-Id" => "262DB79122DE79BFB7C2D27B5AF096F7",
            "Content-TYpe" => "application/json",
            "X-Requested-With" => "XMLHttpRequest",
            "User-Agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36",
            "Referer" => "https://www.trulia.com/mortgage-lender-directory/",
            "Accept-Encoding" => "gzip, deflate, br",
            "Accept-Language" => "en-GB,en-US;q=0.9,en;q=0.8"
        ]
    ]);

    if ($response->getStatusCode() == 200) {
        $data = json_decode($response->getBody()->getContents());
        return response()->json(["lenders" => $data->lenders], 200);
    }
});


Route::get('/locations/{location}', function () {
    $client = new Client([
        'base_uri' => 'https://mortgageapi.zillow.com',
    ]);

    $json = [
        "sort" => "Relevance",
        "pageSize" => 2000,
        "page" => 1,
        "fields" => ["companyName","totalReviews","rating","screenName","imageId","individualName","employerScreenName","nmlsId","recentReviews","confirmedReviews"],
    ];

    if (!is_null(request("location"))) {
        $json["location"] = request("location");
    }

    $response = $client->request('POST', '/getLenderDirectoryListings?partnerId=RD-JGLGMSG', [
        "json" => $json,
        "headers" => [
            "Origin" => "https://www.trulia.com",
            "Accept" => "application/json, text/javascript, */*; q=0.01",
            "X-DevTools-Emulate-Network-Conditions-Client-Id" => "262DB79122DE79BFB7C2D27B5AF096F7",
            "Content-TYpe" => "application/json",
            "X-Requested-With" => "XMLHttpRequest",
            "User-Agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36",
            "Referer" => "https://www.trulia.com/mortgage-lender-directory/",
            "Accept-Encoding" => "gzip, deflate, br",
            "Accept-Language" => "en-GB,en-US;q=0.9,en;q=0.8"
        ]
    ]);

    if ($response->getStatusCode() == 200) {
        $data = json_decode($response->getBody()->getContents());
        return response()->json(["lenders" => $data->lenders], 200);
    }
});

Route::get('/lenders/{lender}', function () {
    $client = new Client([
        'base_uri' => 'https://mortgageapi.zillow.com',
    ]);

    $json = [
        "sort" => "Relevance",
        "pageSize" => 2000,
        "page" => 1,
        "fields" => ["companyName","totalReviews","rating","screenName","imageId","individualName","employerScreenName","nmlsId","recentReviews","confirmedReviews"],
    ];

    if (!is_null(request("lender"))) {
        $json["lenderName"] = request("lender");
    }

    $response = $client->request('POST', '/getLenderDirectoryListings?partnerId=RD-JGLGMSG', [
        "json" => $json,
        "headers" => [
            "Origin" => "https://www.trulia.com",
            "Accept" => "application/json, text/javascript, */*; q=0.01",
            "X-DevTools-Emulate-Network-Conditions-Client-Id" => "262DB79122DE79BFB7C2D27B5AF096F7",
            "Content-TYpe" => "application/json",
            "X-Requested-With" => "XMLHttpRequest",
            "User-Agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36",
            "Referer" => "https://www.trulia.com/mortgage-lender-directory/",
            "Accept-Encoding" => "gzip, deflate, br",
            "Accept-Language" => "en-GB,en-US;q=0.9,en;q=0.8"
        ]
    ]);

    if ($response->getStatusCode() == 200) {
        $data = json_decode($response->getBody()->getContents());
        return response()->json(["lenders" => $data->lenders], 200);
    }
});



Route::get('/places/{prefix}', function () {
    $client = new Client([
        'base_uri' => 'https://ac.zillowstatic.com',
    ]);

    $response = $client->request('get', '/getRegionByPrefix', [
        "query" => [
            "prefix" => request("prefix"),
            "json" => ""
        ],
        "headers" => [
            "Origin" => "https://www.trulia.com",
            "Accept" => "application/json, text/javascript, */*; q=0.01",
            "X-DevTools-Emulate-Network-Conditions-Client-Id" => "262DB79122DE79BFB7C2D27B5AF096F7",
            "Content-TYpe" => "application/json",
            "X-Requested-With" => "XMLHttpRequest",
            "User-Agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36",
            "Referer" => "https://www.trulia.com/mortgage-lender-directory/",
            "Accept-Encoding" => "gzip, deflate, br",
            "Accept-Language" => "en-GB,en-US;q=0.9,en;q=0.8"
        ]
    ]);

    if ($response->getStatusCode() == 200) {
        $data = json_decode($response->getBody()->getContents());
        return response()->json(["locations" => $data->names], 200);
    }
});
