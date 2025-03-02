<?php

namespace App\Console\Commands;

use App\Jobs\FetchFlightsJob;
use App\Services\Agency\FetchAgencyDataService;
use Illuminate\Console\Command;

class FetchAgencyFlightsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:agency-flights';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws \Throwable
     */

    public function handle(): void
    {
        $fetch = new FetchAgencyDataService();
        $fetch->fetchAllFlights();
        $this->info('Job FetchAgencyFlightsJob dispatched successfully.');
    }
}
