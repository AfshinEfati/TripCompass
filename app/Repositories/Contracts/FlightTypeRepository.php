<?php

namespace App\Repositories\Contracts;

use App\Repositories\Interfaces\FlightTypeRepositoryInterface;
use App\Models\FlightType;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FlightTypeRepository extends BaseRepository implements FlightTypeRepositoryInterface
{
    public function __construct(FlightType $model)
    {
        parent::__construct($model);
    }
}
