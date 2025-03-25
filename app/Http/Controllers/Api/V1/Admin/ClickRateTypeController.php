<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateClickRateTypeRequest;
use App\Http\Requests\Api\V1\Admin\UpdateClickRateTypeRequest;
use App\Http\Resources\Api\Admin\ClickRateTypeResource;
use App\Models\ClickRateType;
use App\Services\ClickRateTypeService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class ClickRateTypeController extends Controller
{
    use StatusTrait;

    public function __construct(public ClickRateTypeService $service)
    {
    }

    public function index()
    {
        $types = $this->service->all();
        return $this->successResponse(ClickRateTypeResource::collection($types), 'Click rate types listed successfully');
    }

    public function store(CreateClickRateTypeRequest $request)
    {
        $type = $this->service->store($request->validated());
        return $this->successResponse(new ClickRateTypeResource($type), 'Click rate type created successfully', 201);
    }

    public function show(ClickRateType $clickRateType)
    {
        return $this->successResponse(new ClickRateTypeResource($clickRateType), 'Click rate type retrieved successfully');
    }

    public function update(UpdateClickRateTypeRequest $request, ClickRateType $clickRateType)
    {
        $this->service->update($request->validated(), $clickRateType->id);
        return $this->successResponse(new ClickRateTypeResource($clickRateType), 'Click rate type updated successfully');
    }

    public function destroy(ClickRateType $clickRateType)
    {
        return $this->unauthorizedResponse([], 'Click rate type cannot be deleted');
    }
}
