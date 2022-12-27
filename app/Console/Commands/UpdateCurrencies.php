<?php

namespace App\Console\Commands;

use App\Services\CurrencyApiService;
use Illuminate\Console\Command;

class UpdateCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currencies from the API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CurrencyApiService $currencyApiService)
    {
        $this->info('Updating currencies...');
        $currencyApiService->fetchAndSaveCurrencies();
        $this->info('Currencies updated successfully!');

        return Command::SUCCESS;
    }
}
