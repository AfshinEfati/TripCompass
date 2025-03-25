<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\StatusHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateClickRateRequest;
use App\Http\Requests\Api\V1\Admin\UpdateClickRateRequest;
use App\Http\Resources\Api\Admin\ClickRateResource;
use App\Models\ClickRate;
use App\Services\ClickRateService;
use Illuminate\Http\Request;

class ClickRateController extends Controller
{
    public function __construct(public ClickRateService $service)
    {
    }

    public function index()
    {
        $rates = $this->service->all();
        return StatusHelper::successResponse(ClickRateResource::collection($rates), 'All Click Rates');

    }

    public function store(CreateClickRateRequest $request)
    {
        $rate = $this->service->store($request->validated());
        return StatusHelper::successResponse(new ClickRateResource($rate), 'Created Click Rate');
    }

    public function show(ClickRate $clickRate)
    {
        return StatusHelper::successResponse(new ClickRateResource($clickRate), 'Show Click Rate');
    }

    public function update(UpdateClickRateRequest $request, ClickRate $clickRate)
    {
        $this->service->update($request->validated(), $clickRate->id);
        return StatusHelper::successResponse(new ClickRateResource($clickRate->refresh()), 'Updated Click Rate');
    }

    public function destroy(ClickRate $clickRate)
    {
        $this->service->destroy($clickRate->id);
        return StatusHelper::successResponse([], 'Deleted Click Rate');
    }
}
