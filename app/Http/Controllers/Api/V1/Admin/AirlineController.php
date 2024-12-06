<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateAirlineRequest;
use App\Http\Requests\Api\V1\Admin\UpdateAirlineRequest;
use App\Http\Resources\Api\Admin\AirlineResource;
use App\Models\Airline;
use App\Services\AirlineService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    use StatusTrait;
    public function __construct(public AirlineService $service)
    {
    }

    public function index()
    {
        $airlines = $this->service->all();
        return $this->successResponse(AirlineResource::collection($airlines), 'Airline list');
    }

    public function store(CreateAirlineRequest $request)
    {
        $airline = $this->service->store($request->validated());
        return $this->successResponse(new AirlineResource($airline), 'Airline created', 201);
    }

    public function show(Airline $airline)
    {
        return $this->successResponse(new AirlineResource($airline), 'Airline details');
    }

    public function update(UpdateAirlineRequest $request, Airline $airline)
    {
        $airline = $this->service->update($request->validated(), $airline);
        return $this->successResponse(new AirlineResource($airline), 'Airline updated');
    }

    public function destroy(Airline $airline)
    {
        $this->service->destroy($airline);
        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Airline Delete successfully'
        ]);
    }
}
