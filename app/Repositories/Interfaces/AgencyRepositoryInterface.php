<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface AgencyRepositoryInterface extends BaseRepositoryInterface
{

    public function getByUserId(int|string|null $id);
}
