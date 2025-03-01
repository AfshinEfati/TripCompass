<?php

namespace App\Services;

use App\Repositories\Interfaces\FlightRepositoryInterface;

class FlightService
{
    public function __construct(public FlightRepositoryInterface $repository)
    {
    }

    public function availability(array $data)
    {
        return $this->repository->availability($data);
    }

    public function getSimilarFlights(array $data)
    {
        return $this->repository->getSimilarFlights($data);
    }
}
