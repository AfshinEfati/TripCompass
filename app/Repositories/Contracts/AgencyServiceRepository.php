<?php

namespace App\Repositories\Contracts;

use App\Models\Agency;
use App\Models\AgencyService;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AgencyServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function delete(Agency $agency,AgencyService $agencyService): bool
    {
        $service = $this->model->query()
            ->where('agency_id', $agency->id)
            ->where('id', $agencyService->id)
            ->first();
        if (!$service)
            throw new ModelNotFoundException("این سرویس متعلق به این آژانس نیست.");

        retrun $service->delete();

    }

    public function storeByAgency(Agency $agency, array $data)
    {
        $data['agency_id'] = $agency->id;
        return $this->model->create($data);
    }

    public function updateByAgencyId(Agency $agency, AgencyService $agencyService, mixed $validated)
    {
        $validated['agency_id'] = $agency->id;

        $service = $this->model->query()
            ->where('agency_id', $agency->id)
            ->where('id', $agencyService->id)
            ->first();

        if (!$service) {
            throw new ModelNotFoundException("این سرویس متعلق به این آژانس نیست.");
        }

        $service->update($validated);

        return $service->refresh();
    }
}
