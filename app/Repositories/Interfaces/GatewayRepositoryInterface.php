<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface GatewayRepositoryInterface extends BaseRepositoryInterface
{
    public function getGateway();
}
