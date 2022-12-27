<?php

namespace App\Services;

use App\Models\Currency;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CurrencyApiService
{
    /**
     * @var Client $client
     */
    protected Client $client;

    /**
     * CurrencyApiService constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://api.nbp.pl/',
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * Fetch currencies from the API.
     *
     * @return array
     */
    protected function fetchCurrenciesFromApi(): array
    {
        $response = $this->client->get('/api/exchangerates/tables/A');
        $data = json_decode($response->getBody()->getContents(), true);

        return $data[0]['rates'];
    }

    /**
     * Save currencies to the database.
     *
     * @param  array  $currencies
     * @return void
     */
    protected function saveCurrencies(array $currencies): void
    {
        foreach ($currencies as $currency) {
            Currency::updateOrCreate([
                'name' => $currency['currency'],
                'currency_code' => $currency['code'],
            ], [
                'exchange_rate' => $currency['mid'],
            ]);
        }
    }

    /**
     * Fetch currencies from the API and save them to the database.
     *
     * @return void
     */
    public function fetchAndSaveCurrencies(): void
    {
        $currencies = $this->fetchCurrenciesFromApi();
        $this->saveCurrencies($currencies);
    }
}
