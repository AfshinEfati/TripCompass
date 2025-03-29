<?php

namespace App\Jobs;

use App\Services\Agency\FetchAgencyDataService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class FetchFlightForRouteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vendorInstance;
    protected $origin;
    protected $destination;
    protected $flightDate;
    protected $agencyId;

    public function __construct($vendorInstance, $origin, $destination, $flightDate, $agencyId)
    {
        $this->vendorInstance = $vendorInstance;
        $this->origin = $origin;
        $this->destination = $destination;
        $this->flightDate = $flightDate;
        $this->agencyId = $agencyId;
    }

    public int $tries = 1; // فقط یکبار اجرا شود، هیچ تکراری نباشد
    public int $timeout = 180; // زمان‌بندی برای جلوگیری از timeout

    public function handle(): void
    {
        try {
            $requestData = [
                'origin' => $this->origin,
                'destination' => $this->destination,
                'date' => $this->flightDate,
                'flight_type' => 'one_way',
                'passengers' => [
                    'ADT' => 1,
                    'CHD' => 0,
                    'INF' => 0
                ]
            ];

            $flights = $this->vendorInstance->fetchFlights($requestData);

            if (!empty($flights)) {
                app(FetchAgencyDataService::class)->storeFlightsInDatabase($flights, $this->agencyId);
            }
        } catch (\Throwable $e) {
            $this->fail($e); // جاب را Fail می‌کنیم تا دیگر تکرار نشود
        }
    }
}
