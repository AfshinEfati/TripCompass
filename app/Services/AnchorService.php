<?php

namespace App\Services;

use App\Models\Anchor;
use App\Repositories\Interfaces\AnchorRepositoryInterface;

class AnchorService
{
    public function __construct(public AnchorRepositoryInterface $repository)
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

    public function update(mixed $validated, int $anchor_id)
    {
        return $this->repository->updateById($anchor_id, $validated);
    }

    public function destroy(int $anchor_id)
    {
        return $this->repository->destroy($anchor_id);
    }

    public function allBySeoId($id)
    {
        return $this->repository->allBySeoId($id);
    }
}
