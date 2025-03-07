<?php

namespace App\Http\Controllers\Api\V1\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Panel\Agency\CreateAgencyRequest;
use App\Http\Resources\Api\Admin\AgencyResource;
use App\Models\Agency;
use App\Services\AgencyService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    use StatusTrait;

    public function __construct(public AgencyService $service)
    {
    }

    public function index()
    {
        $agencies = $this->service->getByUserId(auth()->id());
        if (empty($agencies)) {
            return $this->notFoundResponse([], 'Agencies not found');
        } else {
            return $this->successResponse(AgencyResource::collection($agencies), 'All Agencies');
        }
    }

    public function store(CreateAgencyRequest $request)
    {
        $agency = $this->service->store($request->validated());
        return $this->successResponse(AgencyResource::make($agency), 'Agency successfully created');
    }

    public function show(Agency $agency)
    {
        return $this->successResponse(AgencyResource::make($agency), 'Agency');
    }

    public function update(Request $request, Agency $agency)
    {
        return $this->unauthorizedResponse([], 'You are not authorized to update this agency');
    }

    public function destroy(Agency $agency)
    {
        return $this->unauthorizedResponse([], 'You are not authorized to delete this agency');
    }


}
