<?php

namespace App\Services;

use App\Repositories\Interfaces\CountryRepositoryInterface;

class CountryService
{
    public function __construct(public CountryRepositoryInterface $repository)
    {
    }

    public function all()
    {
        return $this->repository->all();
    }
}
