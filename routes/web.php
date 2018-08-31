<?php

use App\Services\Trulia;
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
    $client = new Trulia;

    $response = $client->fetchWithBankOrLocations();
    $data = json_decode($response);
    return response()->json(["lenders" => $data->lenders], 200);
});


Route::get('/locations/{location}', function () {
    $client = new Trulia;

    $response = $client->fetchWithBankOrLocations();
    $data = json_decode($response);
    return response()->json(["lenders" => $data->lenders], 200);
});

Route::get('/lenders/{lender}', function () {
    $client = new Trulia;

    $response = $client->fetchWithBankOrLocations();
    $data = json_decode($response);
    return response()->json(["lenders" => $data->lenders], 200);
});



Route::get('/places/{prefix}', function () {
    $client = new Trulia;

    $response = $client->fetchPlaces();
    $data = json_decode($response);
    return response()->json(["locations" => $data->names], 200);
});
