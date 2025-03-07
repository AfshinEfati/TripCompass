<?php

namespace App\Services;

use App\Repositories\Interfaces\BankRepositoryInterface;

class BankService
{
    public function __construct(public BankRepositoryInterface $repository)
    {
    }
    public function bankList()
    {
        return $this->repository->all();
    }
}
