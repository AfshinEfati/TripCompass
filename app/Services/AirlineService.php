<?php

namespace App\Services;

use App\Models\Airline;
use App\Repositories\Interfaces\AirlineRepositoryInterface;

class AirlineService
{
    public function __construct(public AirlineRepositoryInterface $repository)
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

    public function update(mixed $validated, Airline $airline)
    {
        return $this->repository->update($airline,$validated);
    }

    public function destroy(Airline $airline)
    {
        return $this->repository->destroy($airline->id);
    }
}
