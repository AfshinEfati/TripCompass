<?php

namespace App\Services;

use App\Models\City;
use App\Repositories\Interfaces\CityRepositoryInterface;

class CityService
{
    public function __construct(public CityRepositoryInterface $repository)
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

    public function update(mixed $validated, City $city)
    {
        return $this->repository->update($city,$validated);
    }

    public function destroy(City $city)
    {
        return $this->repository->destroy($city->id);
    }
}
