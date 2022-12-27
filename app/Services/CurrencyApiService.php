<?php

namespace App\Services;

use App\Models\Currency;
use GuzzleHttp\Client;

class CurrencyApiService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://api.nbp.pl/',
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function fetchAndSaveCurrencies()
    {
        $response = $this->client->get('/api/exchangerates/tables/A');
        $data = json_decode($response->getBody()->getContents(), true);

        $currencies = $data[0]['rates'];

        foreach ($currencies as $currency) {
            Currency::updateOrCreate([
                'name' => $currency['currency'],
                'currency_code' => $currency['code'],
            ], [
                'exchange_rate' => $currency['mid'],
            ]);
        }
    }
}
