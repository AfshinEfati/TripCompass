<?php

namespace App\Repositories\Contracts;

use App\Models\AgencyService;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AgencyServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AgencyServiceRepository extends BaseRepository implements AgencyServiceRepositoryInterface
{
    public function __construct(AgencyService $model)
    {
        parent::__construct($model);
    }

    public function getByAgencyId($agencyId)
    {
        return $this->model->where('agency_id', $agencyId)->get();
    }
}
