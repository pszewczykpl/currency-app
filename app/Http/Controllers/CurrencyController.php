<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Services\CurrencyApiService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Show all currencies from the database.
     */
    public function index()
    {
        $currencies = Currency::all();
        return view('currencies.index', compact('currencies'));
    }

    /**
     * Fetch currencies from the API and save them to the database.
     *
     * @param  CurrencyApiService  $currencyApiService
     * @return Application|Factory|View
     */
    public function fetch(CurrencyApiService $currencyApiService)
    {
        $currencyApiService->fetchAndSaveCurrencies();
        return view('currencies.fetch');
    }
}
