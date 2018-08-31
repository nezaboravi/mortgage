<?php

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

Route::get('/locations/{location}/lenders/{lender}', 'MortgageController@bankOrPlaces');

Route::get('/locations/{location}', 'MortgageController@bankOrPlaces');

Route::get('/lenders/{lender}', 'MortgageController@bankOrPlaces');

Route::get('/places/{prefix}', 'MortgageController@places');
