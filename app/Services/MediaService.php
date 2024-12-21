<?php

namespace App\Services;

use App\Repositories\Interfaces\MediaRepositoryInterface;

class MediaService
{
    public function __construct(public MediaRepositoryInterface $repository)
    {
    }

    public function upload(array $data): void
    {
         $this->repository->upload($data);
    }

}
