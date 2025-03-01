<?php

namespace App\Repositories\Contracts;

use App\Models\Flight;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\FlightRepositoryInterface;
use App\Services\AirportService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class FlightRepository extends BaseRepository implements FlightRepositoryInterface
{
    public function __construct(Flight $model, public AirportService $airportService)
    {
        parent::__construct($model);
    }

    public function availability(array $data): Collection
    {
        $data['origin_id'] = $this->airportService->getByIataCode($data['origin']);
        $data['destination_id'] = $this->airportService->getByIataCode($data['destination']);
        $cacheKey = "flights:{$data['origin']}:{$data['destination']}:{$data['date']}:{$data['trip_type']}"
            . ($data['trip_type'] === 'rounded' ? ":{$data['return_date']}" : "");

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($data) {
            return $this->model->query()
                ->with(['origin', 'destination', 'airline', 'agency', 'origin.city', 'destination.city'])
                ->where('origin_id', $data['origin_id'])
                ->where('destination_id', $data['destination_id'])
                ->whereDate('departure_time', $data['date'])
                ->whereRaw('price_details->>"$.adult" = (
                SELECT MIN(price_details->>"$.adult") FROM flights AS f WHERE
                f.origin_id = flights.origin_id AND
                f.destination_id = flights.destination_id AND
                f.departure_time = flights.departure_time AND
                f.arrival_time = flights.arrival_time AND
                f.airline_id = flights.airline_id AND
                f.flight_number = flights.flight_number AND
                f.class = flights.class AND
                f.cabin_type = flights.cabin_type
            )')
                ->orderByRaw('price_details->>"$.adult" ASC')
                ->get();
        });
    }

    public function getSimilarFlights(array $data): Collection
    {
        $flight = $this->model->where('flight_key', $data['flight_key'])->firstOrFail();
        return $this->model->query()
            ->with(['origin', 'destination', 'airline', 'agency', 'origin.city', 'destination.city'])
            ->where('origin_id', $flight->origin_id)
            ->where('destination_id', $flight->destination_id)
            ->where('departure_time', $flight->departure_time)
            ->where('arrival_time', $flight->arrival_time)
            ->where('airline_id', $flight->airline_id)
            ->where('flight_number', $flight->flight_number)
            ->where('class', $flight->class)
            ->where('cabin_type', $flight->cabin_type)
            ->orderByRaw('price_details->>"$.adult" ASC')
            ->get();
    }

    public function redirect(array $validated)
    {
        $flight = $this->model->where('flight_key', $validated['flight_key'])->first();

        if (!$flight) {
            return null;
        }

        return $flight->call_back;
    }
}
