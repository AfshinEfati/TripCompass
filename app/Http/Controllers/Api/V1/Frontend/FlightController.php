<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Frontend\AvailabilityRequest;
use App\Services\FlightService;

class FlightController extends Controller
{
    public function __construct(public FlightService $service)
    {
    }

    public function availability(AvailabilityRequest $request)
    {

    }
}
