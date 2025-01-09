<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface SeoRelationRepositoryInterface extends BaseRepositoryInterface
{
    public function update(Model $model, array $data);
}
