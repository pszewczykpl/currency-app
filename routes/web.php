<?php

use App\Http\Controllers\CurrencyController;
use App\Services\CurrencyApiService;
use Illuminate\Support\Facades\Route;

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
    (new CurrencyApiService())->fetchAndSaveCurrencies();
    echo 'Pobrano dane z API i zapisano do bazy danych.';
});
