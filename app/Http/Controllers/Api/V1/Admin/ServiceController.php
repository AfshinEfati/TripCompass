<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateServiceRequest;
use App\Http\Requests\Api\V1\Admin\UpdateServiceRequest;
use App\Http\Resources\Api\Admin\ServiceResource;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(public ServiceService $service)
    {
    }

    public function index()
    {
        $services = $this->service->all();
        return response()->json([
            'success' => true,
            'data' => ServiceResource::collection($services),
            'message' => 'Get service success'
        ]);
    }

    public function store(CreateServiceRequest $request)
    {
        $service = $this->service->store($request->validated());
        return response()->json([
            'success' => true,
            'data' => ServiceResource::make($service),
            'message' => 'Create service success'
        ]);
    }

    public function show(Service $service)
    {
        return response()->json([
            'success' => true,
            'data' => ServiceResource::make($service),
            'message' => 'Get service success'
        ]);
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service = $this->service->update($request->validated(), $service);
        return response()->json([
            'success' => true,
            'data' => ServiceResource::make($service),
            'message' => 'Update service success'
        ]);
    }

    public function destroy(Service $service)
    {
        $this->service->destroy($service);
        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Service Delete successfully'
        ]);
    }
}
