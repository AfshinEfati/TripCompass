<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface AirportRepositoryInterface extends BaseRepositoryInterface
{

    public function getAirports(string|null $query);

    public function getByIataCode(mixed $destination);
}
