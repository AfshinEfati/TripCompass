<?php

namespace App\Services;

use App\Repositories\Interfaces\TicketMessageRepositoryInterface;

class TicketMessageService
{
    public function __construct(public TicketMessageRepositoryInterface $repository)
    {
    }

    public function all(int $id)
    {
        return $this->repository->all($id);
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

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }
}
