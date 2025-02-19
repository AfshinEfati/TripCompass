<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Frontend\AvailabilityRequest;
use app\Http\Resources\Api\Frontend\FlightResource;
use App\Services\FlightService;
use App\Traits\StatusTrait;

class FlightController extends Controller
{
    use StatusTrait;

    public function __construct(public FlightService $service)
    {
    }

    public function availability(AvailabilityRequest $request)
    {
        $flights = $this->service->availability($request->validated());
        return $this->successResponse(FlightResource::collection($flights), 'Flights List');
    }
}
