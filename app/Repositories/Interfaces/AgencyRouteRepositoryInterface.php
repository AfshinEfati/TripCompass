<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface AgencyRouteRepositoryInterface extends BaseRepositoryInterface
{

    public function getByAgencyId(int $agencyId);
}
