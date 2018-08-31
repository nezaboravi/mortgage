<?php

namespace App\Services;

use GuzzleHttp\Client;

class Trulia
{
    public function fetch($base, $uri)
    {
        $client = new Client([
            'base_uri' => $base,
        ]);
        $json = [
                "sort" => request("sort", "Relevance"),
                "pageSize" => request("size", 2000),
                "page" => request("page", 1),
                "fields" => ["companyName","totalReviews","rating","screenName","imageId","individualName","employerScreenName","nmlsId","recentReviews","confirmedReviews"],
                "location" => request("location")
            ];

        if (!is_null(request("lender"))) {
            $json["lenderName"] = request("lender");
        }

        $response = $client->request('POST', $uri, [
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
            return $response->getBody()->getContents();
        }

        return null;
    }
}
