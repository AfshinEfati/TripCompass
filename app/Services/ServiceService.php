<?php

namespace App\Services;

use App\Models\Service;
use App\Repositories\Interfaces\CityRepositoryInterface;

class ServiceService
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

    public function update(mixed $validated, Service $service)
    {
        return $this->repository->update($service,$validated);
    }

    public function destroy(Service $service)
    {
        return $this->repository->destroy($service->id);
    }
}
