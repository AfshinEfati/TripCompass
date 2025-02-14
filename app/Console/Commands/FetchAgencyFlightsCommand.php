<?php

namespace App\Console\Commands;

use App\Jobs\FetchAgencyFlightsJob;
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
     */

    public function handle(): void
    {
        dispatch(new FetchAgencyFlightsJob());
        $this->info('Job FetchAgencyFlightsJob dispatched successfully.');
    }
}
