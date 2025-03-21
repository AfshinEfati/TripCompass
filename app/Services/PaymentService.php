<?php

namespace App\Services;

use App\Repositories\Interfaces\PaymentRepositoryInterface;

class PaymentService
{
    public function __construct(public PaymentRepositoryInterface $repository,public GatewayService $gatewayService)
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

    public function pay(mixed $validated)
    {
        return $this->repository->pay($validated);
    }
}
