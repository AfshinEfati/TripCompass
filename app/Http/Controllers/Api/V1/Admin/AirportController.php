<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateAirportRequest;
use App\Http\Requests\Api\V1\Admin\UpdateAirportRequest;
use App\Http\Resources\Api\Admin\AirportResource;
use App\Models\Airport;
use App\Services\AirportService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    use StatusTrait;
    public function __construct(public AirportService $service)
    {
    }

    public function index()
    {
        $airports = $this->service->all();
        return $this->successResponse(AirportResource::collection($airports), 'Airports retrieved successfully');
    }

    public function store(CreateAirportRequest $request)
    {
        $airport = $this->service->store($request->validated());
        return $this->successResponse(new AirportResource($airport), 'Airport created successfully', 201);
    }

    public function show(Airport $airport)
    {
        return $this->successResponse(new AirportResource($airport), 'Airport retrieved successfully');
    }

    public function update(UpdateAirportRequest $request, Airport $airport)
    {
        $airport = $this->service->update($request->validated(),$airport);
        return $this->successResponse(new AirportResource($airport), 'Airport updated successfully');
    }

    public function destroy(Airport $airport)
    {
        $this->service->destroy($airport);
        return $this->successResponse(null, 'Airport deleted successfully');
    }
}
