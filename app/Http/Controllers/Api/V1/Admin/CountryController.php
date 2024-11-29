<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateCountryRequest;
use App\Http\Requests\Api\V1\Admin\UpdateCountryRequest;
use App\Http\Resources\Api\Admin\CountryResource;
use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(public CountryService $service)
    {

    }

    public function index()
    {
        $countries = $this->service->all();
        if ($countries->isNotEmpty())
            return response()->json([
                'success' => true,
                'data' => CountryResource::collection($countries),
                'message' => 'Country list'
            ]);
        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Country is empty!'
        ]);
    }

    public function store(CreateCountryRequest $request)
    {
        $country = $this->service->store($request->validated());
        return response()->json([
            'success' => true,
            'data' => CountryResource::make($country),
            'message' => 'Country Created Successfully!'
        ]);
    }

    public function show(Country $country)
    {
        return response()->json([
            'success' => true,
            'data' => CountryResource::make($country),
            'message' => 'Country Detail'
        ]);
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country = $this->service->update($request->validated(), $country);
        return response()->json([
            'success' => true,
            'data' => CountryResource::make($country),
            'message' => 'Country Updated Successfully!'
        ]);
    }

    public function destroy(Country $country)
    {
        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'You cant delete !'
        ]);
    }
}
