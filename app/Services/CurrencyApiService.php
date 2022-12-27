<?php

namespace App\Services;

use App\Models\Currency;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CurrencyApiService
{
    /**
     * Client instance.
     *
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
     * @throws GuzzleException
     */
    protected function fetchCurrenciesFromApi(): array
    {
        // Try to fetch currencies from the API.
        try {
            $response = $this->client->get('/api/exchangerates/tables/A');
            $data = json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // General 500 error if something went wrong.
            abort(500);
        }

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
        // Start a database transaction.
        DB::beginTransaction();

        // Try to save currencies to the database.
        try {
            foreach ($currencies as $currency) {
                Currency::updateOrCreate([
                    'name' => $currency['currency'],
                    'currency_code' => $currency['code'],
                ], [
                    'exchange_rate' => $currency['mid'],
                ]);
            }

            // Commit the transaction if everything ok.
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction if something went wrong.
            DB::rollback();

            // General 500 error if something went wrong.
            abort(500);
        }
    }

    /**
     * Fetch currencies from the API and save them to the database.
     *
     * @return void
     * @throws GuzzleException
     */
    public function fetchAndSaveCurrencies(): void
    {
        $currencies = $this->fetchCurrenciesFromApi();
        $this->saveCurrencies($currencies);
    }
}
