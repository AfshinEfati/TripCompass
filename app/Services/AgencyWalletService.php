<?php

namespace App\Services;

use App\Repositories\Interfaces\AgencyWalletRepositoryInterface;

class AgencyWalletService
{
    public function __construct(public AgencyWalletRepositoryInterface $repository)
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

    public function update(mixed $validated, mixed $id)
    {
        return $this->repository->update($id, $validated);
    }

    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }

    public function charge(mixed $validated)
    {
        return $this->repository->charge($validated);
    }

    public function list()
    {
        return $this->repository->list();
    }
}
