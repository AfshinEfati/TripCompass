<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface FaqRepositoryInterface
{
    public function all(int $id);

    public function store(mixed $validated);

    public function update(mixed $id, mixed $validated);

    public function destroy(int $id);

    public function findById(int $id);

}
