<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    public function __construct(public UserRepositoryInterface $repository)
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

    public function update(mixed $validated, User $user)
    {
        return $this->repository->update($user, $validated);
    }

    public function destroy(User $user)
    {
        return $this->repository->destroy($user->id);
    }
}
