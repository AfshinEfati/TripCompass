<?php

namespace App\Services;

use App\Models\Airport;
use App\Repositories\Interfaces\AirportRepositoryInterface;

class AirportService
{
    public function __construct(public AirportRepositoryInterface $repository)
    {
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function store(mixed $validated)
    {
        return $this->repository->store($validated);
    }

    public function update(mixed $validated, Airport $airport)
    {
        return $this->repository->update($airport, $validated);
    }

    public function destroy(Airport $airport)
    {
        return $this->repository->destroy($airport->id);
    }

    public function getAirports(mixed $query)
    {
        return $this->repository->getAirports($query);
    }
}
