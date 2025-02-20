<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateAgencyServiceRequest;
use App\Http\Requests\Api\V1\Admin\UpdateAgencyServiceRequest;
use App\Http\Resources\Api\Admin\AgencyServiceResource;
use App\Models\Agency;
use App\Models\AgencyService;
use App\Services\AgencyServiceService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;

class AgencyServiceController extends Controller
{
    use StatusTrait;
    public function __construct(public AgencyServiceService $service)
    {

    }

    public function index(Agency $agency)
    {
        $services =  $this->service->getByAgencyId($agency->id);
        if ($services->isEmpty()) {
            return $this->successResponse([], 'No Services Found');
        }
        return $this->successResponse(AgencyServiceResource::collection($services), 'All Services');
    }

    public function store(Agency $agency,CreateAgencyServiceRequest $request)
    {
        $service =  $this->service->store($agency,$request->validated());
        return $this->successResponse(new AgencyServiceResource($service), 'Service Created Successfully');
    }

    public function show(AgencyService $agencyService)
    {
        return $this->successResponse(new AgencyServiceResource($agencyService), 'Service Details');
    }

    public function update(UpdateAgencyServiceRequest $request, AgencyService $agencyService)
    {
        $agencyService =  $this->service->update($request->validated(),$agencyService);
        return $this->successResponse(new AgencyServiceResource($agencyService), 'Service Updated Successfully');
    }

    public function destroy(int $agencyId,int $agencyServiceId)
    {
        $this->service->destroy($agencyId,$agencyServiceId);
        return $this->successResponse([], 'Service Deleted Successfully');
    }
}
