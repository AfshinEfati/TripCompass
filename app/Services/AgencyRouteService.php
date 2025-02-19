<?php

namespace App\Services;

use App\Models\AgencyRoute;
use App\Repositories\Interfaces\AgencyRouteRepositoryInterface;

class AgencyRouteService
{
    public function __construct(public AgencyRouteRepositoryInterface $repository)
    {
    }

    public function getByAgencyId(int $agencyId)
    {
        return $this->repository->getByAgencyId($agencyId);
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function update(AgencyRoute $agencyRoute, $data)
    {
        return $this->repository->update($agencyRoute, $data);
    }

    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }
}
