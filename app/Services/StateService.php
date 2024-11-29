<?php

namespace App\Services;

use App\Models\Country;
use App\Models\State;
use App\Repositories\Interfaces\StateRepositoryInterface;

class StateService
{
    public function __construct(public StateRepositoryInterface $repository)
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

    public function update(mixed $validated, State $state)
    {
        return $this->repository->update($state,$validated);
    }

    public function destroy(State $state)
    {
        return $this->repository->destroy($state->id);
    }
}
