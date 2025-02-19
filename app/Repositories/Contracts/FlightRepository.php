<?php

namespace App\Repositories\Contracts;

use App\Models\Flight;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\FlightRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class FlightRepository extends BaseRepository implements FlightRepositoryInterface
{
    public function __construct(Flight $model)
    {
        parent::__construct($model);
    }
    public function availability(array $data): Collection
    {
        return $this->model->query()
            ->with(['origin','destination','airline','agency'])
            ->where('origin_id', $data['origin_id'])
            ->where('destination_id', $data['destination_id'])
            ->whereDate('departure_time', $data['date'])
            ->where('status', 'available')->get();
    }
}
