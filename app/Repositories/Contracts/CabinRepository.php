<?php

namespace App\Repositories\Contracts;

use App\Repositories\Interfaces\CabinRepositoryInterface;
use App\Models\Cabin;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CabinRepository extends BaseRepository implements CabinRepositoryInterface
{
    public function __construct(Cabin $model)
    {
        parent::__construct($model);
    }
}
