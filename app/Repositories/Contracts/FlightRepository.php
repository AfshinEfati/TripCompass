<?php

namespace App\Repositories\Contracts;

use App\Models\Flight;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\FlightRepositoryInterface;
use App\Services\AirportService;
use Illuminate\Database\Eloquent\Collection;

class FlightRepository extends BaseRepository implements FlightRepositoryInterface
{
    public function __construct(Flight $model,public AirportService $airportService)
    {
        parent::__construct($model);
    }
    public function availability(array $data): Collection
    {
        $data['origin_id'] = $this->airportService->getByIataCode($data['origin']);
        $data['destination_id'] = $this->airportService->getByIataCode($data['destination']);
        return $this->model->query()
            ->with(['origin','destination','airline','agency'])
            ->where('origin_id', $data['origin_id'])
            ->where('destination_id', $data['destination_id'])
            ->whereDate('departure_time', $data['date'])->get();
    }
}
