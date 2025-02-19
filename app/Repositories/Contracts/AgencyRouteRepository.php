<?php

namespace App\Repositories\Contracts;

use App\Models\AgencyRoute;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AgencyRouteRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class AgencyRouteRepository extends BaseRepository implements AgencyRouteRepositoryInterface
{
    public function __construct(AgencyRoute $model)
    {
        parent::__construct($model);
    }

    public function getByAgencyId(int $agencyId): Collection
    {
        return $this->model->query()->with(['origin', 'destination'])->where('agency_id', $agencyId)->get();
    }

}
