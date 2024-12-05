<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateAgencyRequest;
use App\Http\Requests\Api\V1\Admin\UpdateAgencyRequest;
use App\Http\Resources\Api\Admin\AgencyResource;
use App\Models\Agency;
use App\Services\AgencyService;
use App\Traits\StatusTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    use StatusTrait;
    public function __construct(public AgencyService $service)
    {
    }

    public function index(): JsonResponse
    {
        $agencies = $this->service->all();
        return $this->successResponse(AgencyResource::collection($agencies), 'All Agencies');

    }

    public function store(CreateAgencyRequest $request)
    {
        $validated = $request->validated();
        $agency = $this->service->store($validated);
        return $this->successResponse(new AgencyResource($agency), 'Agency Created Successfully');
    }

    public function show(Agency $agency)
    {
        return $this->successResponse(new AgencyResource($agency), 'Agency Details');
    }

    public function update(UpdateAgencyRequest $request, Agency $agency)
    {
        $validated = $request->validated();
        $agency = $this->service->update($validated, $agency);
        return $this->successResponse(new AgencyResource($agency), 'Agency Updated Successfully');
    }

    public function destroy(Agency $agency)
    {
        $this->service->destroy($agency);
        return $this->successResponse([], 'Agency Deleted Successfully');
    }
}
