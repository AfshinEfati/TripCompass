<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface AgencyServiceRepositoryInterface extends BaseRepositoryInterface
{

    public function getByAgencyId($agencyId);
}
