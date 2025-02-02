<?php

namespace App\Repositories\Contracts;

use App\Models\Agency;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AgencyRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AgencyRepository extends BaseRepository implements AgencyRepositoryInterface
{
    public function __construct(Agency $model)
    {
        parent::__construct($model);
    }
}
