<?php

namespace App\Http\Controllers;

use App\Services\Trulia;
use Illuminate\Http\Request;

class MortgageController extends Controller
{
    public function bankOrPlaces()
    {
        $client = new Trulia;

        $response = $client->fetchWithBankOrLocations();
        $data = json_decode($response);
        return response()->json(["lenders" => $data->lenders], 200);
    }

    public function places()
    {
        $client = new Trulia;

        $response = $client->fetchPlaces();
        $data = json_decode($response);
        return response()->json(["locations" => $data->names], 200);
    }
}
