<?php

namespace App\Repositories\Contracts;

use App\Models\Flight;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\FlightRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FlightRepository extends BaseRepository implements FlightRepositoryInterface
{
    public function __construct(Flight $model)
    {
        parent::__construct($model);
    }
}
