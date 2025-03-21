<?php

namespace App\Repositories\Contracts;

use App\Models\Gateway;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\GatewayRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class GatewayRepository extends BaseRepository implements GatewayRepositoryInterface
{
    public function __construct(Gateway $model)
    {
        parent::__construct($model);
    }

    public function getGateway()
    {
        $gateway= $this->model->where('is_default', 1)->where('status',1)->first();
        if (!$gateway) {
            $gateway = $this->model->where('status', 1)->first();
        }
        return $gateway;
    }
}
