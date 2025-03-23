<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateFlightTypeRequest;
use App\Http\Requests\Api\V1\Admin\UpdateFlightTypeRequest;
use App\Http\Resources\Api\Admin\FlightTypeResource;
use App\Models\FlightType;
use App\Services\FlightTypeService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class FlightTypeController extends Controller
{
    use StatusTrait;
    public function __construct(public FlightTypeService $service)
    {
    }

    public function index()
    {
        $types = $this->service->all();
        return $this->successResponse(FlightTypeResource::collection($types), 'Flight Types');
    }

    public function store(CreateFlightTypeRequest $request)
    {
        $validated = $request->validated();
        $this->service->store($validated);
        return $this->successResponse([], 'Flight Type Created Successfully', 201);
    }

    public function show(FlightType $flightType)
    {
        return $this->successResponse(new FlightTypeResource($flightType), 'Flight Type');
    }

    public function update(UpdateFlightTypeRequest $request, FlightType $flightType)
    {
        $validated = $request->validated();
        $this->service->update($validated, $flightType->id);
        return $this->successResponse([], 'Flight Type Updated Successfully');
    }

    public function destroy(FlightType $flightType)
    {
        $this->service->destroy($flightType->id);
        return $this->successResponse([], 'Flight Type Deleted Successfully');
    }
}
