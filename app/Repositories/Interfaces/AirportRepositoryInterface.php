<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface AirportRepositoryInterface extends BaseRepositoryInterface
{

    public function getAirports(mixed $query);
}
