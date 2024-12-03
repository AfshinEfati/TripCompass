<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateServiceRequest;
use App\Http\Requests\Api\V1\Admin\UpdateServiceRequest;
use App\Http\Resources\Api\Admin\ServiceResource;
use App\Models\Service;
use App\Services\ServiceService;
use App\Traits\StatusTrait;

class ServiceController extends Controller
{
    use StatusTrait;
    public function __construct(public ServiceService $service) {}



    public function index()
    {
        $services = $this->service->all();
        return $this->successResponse(ServiceResource::collection($services), 'Get service success');
    }

    public function store(CreateServiceRequest $request)
    {
        $service = $this->service->store($request->validated());
        return $this->successResponse(ServiceResource::make($service), 'Create service success');
    }

    public function show(Service $service)
    {
        return $this->successResponse(ServiceResource::make($service), 'Get service success');
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $updatedService = $this->service->update($request->validated(), $service);
        return $this->successResponse(ServiceResource::make($updatedService), 'Update service success');
    }

    public function destroy(Service $service)
    {
        $this->service->destroy($service);
        return $this->successResponse(null, 'Service deleted successfully');
    }
}
