<?php

namespace App\Repositories\Contracts;

use App\Models\Agency;
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

    public function delete($agencyId, $agencyServiceId): bool
    {
        $service = $this->model->where('agency_id', $agencyId)->where('id', $agencyServiceId)->first();
        if ($service) {
            $service->delete();
            return true;
        }
        return false;
    }

    public function storeByAgency(Agency $agency, array $data)
    {
        $data['agency_id'] = $agency->id;
        return $this->model->create($data);
    }

    public function updateByAgencyId(Agency $agency, AgencyService $agencyService, mixed $validated): bool
    {
        $validated['agency_id']=$agency->id;
        return $this->model->query()->findOrFail($agencyService->id)->update($validated);

    }
}
