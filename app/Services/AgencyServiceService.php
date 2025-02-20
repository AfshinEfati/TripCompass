<?php

namespace App\Services;
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

    public function store(mixed $validated)
    {
        return $this->repository->store($validated);
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
}
