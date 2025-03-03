<?php

namespace App\Services;

use App\Repositories\Interfaces\ClickLogRepositoryInterface;

class ClickLogService
{
    public function __construct(public ClickLogRepositoryInterface $repository)
    {
    }
    public function create(array $data)
    {
        return $this->repository->create($data);
    }
}
