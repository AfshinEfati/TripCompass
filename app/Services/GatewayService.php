<?php

namespace App\Services;

use App\Repositories\Interfaces\GatewayRepositoryInterface;

class GatewayService
{
    public function __construct(public GatewayRepositoryInterface $repository)
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

    public function find(int $id)
    {
        return $this->repository->show($id);
    }

    public function update(mixed $validated, int $id)
    {
        return $this->repository->update($id, $validated);
    }

    public function getGateway()
    {
        return $this->repository->getGateway();
    }
}
