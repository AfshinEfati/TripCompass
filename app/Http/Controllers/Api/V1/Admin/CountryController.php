<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
    }

    public function show(Country $country)
    {
    }

    public function update(Request $request, Country $country)
    {
    }

    public function destroy(Country $country)
    {
    }
}
