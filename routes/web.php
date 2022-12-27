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

/**
 * Redirect to the /currencies from the home page.
 */
Route::redirect('/', '/currencies');

/**
 * Fetch currencies from the API and save them to the database.
 */
Route::get('/currencies/fetch', [CurrencyController::class, 'fetch'])->name('currencies.fetch');

/**
 * Show all currencies from the database.
 */
Route::get('/currencies', [CurrencyController::class, 'index'])->name('currencies.index');
