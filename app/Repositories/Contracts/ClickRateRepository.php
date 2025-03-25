<?php

namespace App\Repositories\Contracts;

use App\Repositories\Interfaces\ClickRateRepositoryInterface;
use App\Models\ClickRate;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ClickRateRepository extends BaseRepository implements ClickRateRepositoryInterface
{
    public function __construct(ClickRate $model)
    {
        parent::__construct($model);
    }
}
