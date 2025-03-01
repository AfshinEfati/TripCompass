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
use Throwable;

class FetchFlightsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 1;
    public int $timeout = 300;

    public function handle(FetchAgencyDataService $fetchService): void
    {
        try {
            $fetchService->fetchAllFlights();
        } catch (\Throwable $e) {
            \Log::error("❌ FetchFlightsJob Failed: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            $this->fail($e);
        }
    }
}

