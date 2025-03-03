<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface ClickLogRepositoryInterface extends BaseRepositoryInterface
{
    public function create(array $data);
}
