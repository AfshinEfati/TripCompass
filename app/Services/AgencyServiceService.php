<?php

namespace App\Services;
use App\Models\Agency;
use App\Models\AgencyService;
use App\Repositories\Interfaces\AgencyServiceRepositoryInterface;

class AgencyServiceService
{
    public function __construct(public AgencyServiceRepositoryInterface $repository)
    {
    }
    public function all()
    {
        return $this->repository->all();
    }

    public function store(Agency $agency,array $data)
    {

        return $this->repository->storeByAgency($agency,$data);
    }

    public function update(mixed $validated, AgencyService $agencyService)
    {
        return $this->repository->update($agencyService,$validated);
    }

    public function destroy($agencyId,$agencyServiceId)
    {
        return $this->repository->delete($agencyId,$agencyServiceId);
    }

    public function getByAgencyId($agencyId)
    {
        return $this->repository->getByAgencyId($agencyId);
    }

    public function updateByAgencyId(Agency $agency, AgencyService $agencyService, mixed $validated)
    {
        return $this->repository->updateByAgencyId($agency,$agencyService,$validated);
    }
}
