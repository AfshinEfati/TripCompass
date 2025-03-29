<?php

namespace App\Services;

use App\Models\ClickRate;
use App\Repositories\Interfaces\ClickRateRepositoryInterface;

class ClickRateService
{
    public function __construct(public ClickRateRepositoryInterface $repository)
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

    public function update(mixed $validated, ClickRate $clickRate)
    {
        return $this->repository->update($clickRate, $validated);
    }

    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }

}
