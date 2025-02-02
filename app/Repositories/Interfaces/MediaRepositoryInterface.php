<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface MediaRepositoryInterface
{
    public function upload(array $data): Collection;
    public function delete(int $id): bool;

}
