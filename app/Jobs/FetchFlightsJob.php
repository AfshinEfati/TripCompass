<?php

namespace App\Jobs;

use App\Models\AgencyService;
use App\Services\Agency\FetchAgencyDataService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Throwable;

class FetchFlightsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @throws Throwable
     */
    public function handle(FetchAgencyDataService $fetchService)
    {
        Log::info("FetchFlightsJob started.");

        // Call the service to fetch flights
        $fetchService->fetchAllFlights();

        Log::info("FetchFlightsJob completed.");
    }
}

