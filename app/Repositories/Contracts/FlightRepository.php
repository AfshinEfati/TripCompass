<?php

namespace App\Repositories\Contracts;

use App\Jobs\LogClickJob;
use App\Models\Flight;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\FlightRepositoryInterface;
use App\Services\AirportService;
use App\Services\ClickLogService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class FlightRepository extends BaseRepository implements FlightRepositoryInterface
{
    public function __construct(Flight $model, public AirportService $airportService, public ClickLogService $clickLogService)
    {
        parent::__construct($model);
    }

    public function availability(array $data): Collection
    {
        $data['origin_id'] = $this->airportService->getByIataCode($data['origin']);
        $data['destination_id'] = $this->airportService->getByIataCode($data['destination']);

        $cacheKey = "flights:{$data['origin']}:{$data['destination']}:{$data['date']}:{$data['trip_type']}"
            . ($data['trip_type'] === 'rounded' ? ":{$data['return_date']}" : "");

        $sub = $this->model->query()
            ->selectRaw('MIN(CAST(price_details->>"$.adult" AS UNSIGNED)) as min_price,
            origin_id, destination_id, departure_time, arrival_time, airline_id, flight_number, class, cabin_type')
            ->where('origin_id', $data['origin_id'])
            ->where('destination_id', $data['destination_id'])
            ->whereDate('departure_time', $data['date'])
            ->groupBy('origin_id', 'destination_id', 'departure_time', 'arrival_time', 'airline_id', 'flight_number', 'class', 'cabin_type');

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($sub) {
            return $this->model->query()
                ->joinSub($sub, 'min_prices', function ($join) {
                    $join->on('flights.origin_id', '=', 'min_prices.origin_id')
                        ->on('flights.destination_id', '=', 'min_prices.destination_id')
                        ->on('flights.departure_time', '=', 'min_prices.departure_time')
                        ->on('flights.arrival_time', '=', 'min_prices.arrival_time')
                        ->on('flights.airline_id', '=', 'min_prices.airline_id')
                        ->on('flights.flight_number', '=', 'min_prices.flight_number')
                        ->on('flights.class', '=', 'min_prices.class')
                        ->on('flights.cabin_type', '=', 'min_prices.cabin_type')
                        ->whereRaw('CAST(flights.price_details->>"$.adult" AS UNSIGNED) = min_prices.min_price');
                })
                ->with([
                    'origin',
                    'destination',
                    'airline',
                    'agency',
                    'origin.city',
                    'destination.city'
                ])
                ->whereHas('agency', function ($query) {
                    $query->where('is_active', true)
                        ->whereHas('services', function ($q) {
                            $q->where('is_active', true);
                        });
                })
                ->orderByRaw('CAST(flights.price_details->>"$.adult" AS UNSIGNED) ASC')
                ->get();
        });
    }



    public function getSimilarFlights(array $data): Collection
    {
        $flight = $this->model->where('flight_key', $data['flight_key'])->firstOrFail();

        return $this->similarFlightsQuery($flight)
            ->orderByRaw('price_details->>"$.adult" ASC')
            ->get();
    }
    private function similarFlightsQuery(Flight $flight)
    {
        return $this->model->query()
            ->with(['origin', 'destination', 'airline', 'agency', 'origin.city', 'destination.city'])
            ->where('origin_id', $flight->origin_id)
            ->where('destination_id', $flight->destination_id)
            ->where('departure_time', $flight->departure_time)
            ->where('arrival_time', $flight->arrival_time)
            ->where('airline_id', $flight->airline_id)
            ->where('flight_number', $flight->flight_number)
            ->where('class', $flight->class)
            ->where('cabin_type', $flight->cabin_type);
    }

    public function redirect(array $validated)
    {
        $flight = $this->model->where('flight_key', $validated['flight_key'])->first();

        if (!$flight) {
            return null;
        }
        $date =$flight->departure_time->format('Y-m-d');
        $data = [
            'agency_id' => $flight->agency_id,
            'service_id' => 1,
            'description' => "Flight from {$flight->origin->iata_code} to {$flight->destination->iata_code} date {$date}",
            'clicked_at' => now(),
        ];

        LogClickJob::dispatch($data)->afterResponse();
        return $flight->call_back;
    }
}
