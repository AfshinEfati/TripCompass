<?php

namespace App\Services;

use App\Models\Country;
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

    public function store(mixed $validated)
    {
        return $this->repository->store($validated);
    }

    public function update(mixed $validated, Country $country)
    {
        return $this->repository->update($country,$validated);
    }

}
