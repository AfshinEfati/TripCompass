<?php

namespace App\Services;

use App\Repositories\Interfaces\MediaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MediaService
{
    public function __construct(public MediaRepositoryInterface $repository)
    {
    }

    public function upload(array $data): Collection
    {
         return $this->repository->upload($data);
    }

}
