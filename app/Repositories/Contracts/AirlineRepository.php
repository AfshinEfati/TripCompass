<?php

namespace App\Repositories\Contracts;

use App\Models\Airline;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AirlineRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AirlineRepository extends BaseRepository implements AirlineRepositoryInterface
{
    public function __construct(Airline $model)
    {
        parent::__construct($model);
    }
}
