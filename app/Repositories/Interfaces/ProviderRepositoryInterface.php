<?php

namespace App\Repositories\Interfaces;

use App\Models\Provider;
use App\Repositories\BaseRepositoryInterface;

interface ProviderRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEmail(string $email): ?Provider;
}
