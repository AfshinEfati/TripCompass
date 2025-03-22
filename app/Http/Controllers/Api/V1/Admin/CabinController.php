<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateCabinRequest;
use App\Http\Requests\Api\V1\Admin\UpdateCabinRequest;
use App\Http\Resources\Api\Admin\CabinResource;
use App\Models\Cabin;
use App\Services\CabinService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class CabinController extends Controller
{
    use StatusTrait;

    public function __construct(public CabinService $service)
    {
    }

    public function index()
    {
        $cabins = $this->service->all();
        return $this->successResponse(CabinResource::collection($cabins), 'All cabins retrieved successfully.');

    }

    public function store(CreateCabinRequest $request)
    {
        $cabin = $this->service->store($request->validated());
        return $this->successResponse(new CabinResource($cabin), 'Cabin created successfully.');
    }

    public function show(Cabin $cabin)
    {
        return $this->successResponse(new CabinResource($cabin), 'Cabin showed successfully.');
    }

    public function update(UpdateCabinRequest $request, Cabin $cabin)
    {
        $cabin = $this->service->update($request->validated(), $cabin->id);
        return $this->successResponse([], 'Cabin updated successfully.');
    }

    public function destroy(Cabin $cabin)
    {
        return $this->unauthorizedResponse([], 'you are not authorized to delete this cabin.');
    }
}
