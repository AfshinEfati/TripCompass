<?php

namespace App\Services;

use App\Models\Contract;
use App\Repositories\Interfaces\ContractRepositoryInterface;

class ContractService
{
    public function __construct(public ContractRepositoryInterface $repository)
    {
    }

    public function createByAgency(mixed $validated): Contract
    {
        return $this->repository->createByAgency($validated);
    }

}
