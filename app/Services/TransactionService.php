<?php

namespace App\Services;

use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionService
{
    public function __construct(public TransactionRepositoryInterface $repository)
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

    public function getByUserId()
    {
        return $this->repository->getByUserId();
    }
}
