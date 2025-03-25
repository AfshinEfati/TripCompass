<?php

namespace App\Services;

use App\Models\Agency;
use App\Repositories\Interfaces\AgencyRepositoryInterface;

class AgencyService
{
    public function __construct(public AgencyRepositoryInterface $repository)
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

    public function update(mixed $validated, Agency $agency)
    {
        return $this->repository->update($agency,$validated);
    }

    public function destroy(Agency $agency)
    {
        return $this->repository->destroy($agency->id);
    }

    public function getByUserId(int|string|null $id)
    {
        return $this->repository->getByUserId($id);
    }

    public function find(Agency $agency)
    {
        return $this->repository->show($agency->id);
    }

}
