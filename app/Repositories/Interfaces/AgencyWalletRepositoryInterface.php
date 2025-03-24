<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface AgencyWalletRepositoryInterface extends BaseRepositoryInterface
{
    //
    public function charge(mixed $validated);
}
