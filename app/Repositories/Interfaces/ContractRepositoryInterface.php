<?php

namespace App\Repositories\Interfaces;

use App\Models\Contract;
use App\Repositories\BaseRepositoryInterface;

interface ContractRepositoryInterface extends BaseRepositoryInterface
{
    public function getByAgencyId(string $agencyId): Contract;
    public function getByUserId(int $userId): Contract;
    public function createByAgency(array $data);
}
