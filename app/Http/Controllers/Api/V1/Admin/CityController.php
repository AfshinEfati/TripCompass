<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateCityRequest;
use App\Http\Requests\Api\V1\Admin\UpdateCityRequest;
use App\Http\Resources\Api\Admin\CityResource;
use App\Models\City;
use App\Services\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(public CityService $service)
    {
    }

    public function index()
    {
        $cities = $this->service->all();
        return response()->json([
            'success' => true,
            'cities' => CityResource::collection($cities),
            'message'=>'List of all cities'
        ]);
    }

    public function store(CreateCityRequest $request)
    {
        $city = $this->service->store($request->validated());
        return response()->json([
            'success' => true,
            'city' => new CityResource($city),
            'message'=>'City created successfully'
        ]);
    }

    public function show(City $city)
    {
        return response()->json([
            'success' => true,
            'city' => new CityResource($city),
            'message'=>'City retrieved successfully'
        ]);
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city = $this->service->update($request->validated(), $city);
        return response()->json([
            'success' => true,
            'message'=>'City updated successfully',
            'data'=>CityResource::make($city)
        ]);
    }

    public function destroy(City $city)
    {
        $this->service->destroy($city);
        return response()->json([
            'success' => true,
            'message'=>'City deleted successfully',
            'data'=>null
        ]);
    }
}
