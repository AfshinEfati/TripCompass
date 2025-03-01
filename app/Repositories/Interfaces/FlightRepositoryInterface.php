<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface FlightRepositoryInterface extends BaseRepositoryInterface
{

    public function availability(array $data);
    public function getSimilarFlights(array $data);

    public function redirect(array $validated);
}
