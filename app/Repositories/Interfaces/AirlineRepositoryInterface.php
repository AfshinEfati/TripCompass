<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface AirlineRepositoryInterface extends BaseRepositoryInterface
{

    public function getAirlineIdByCode($code);
}
