<?php

namespace App\Http\Controllers\Api\V1\Panel;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Admin\AgencyResource;
use App\Models\Agency;
use App\Services\AgencyService;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function __construct(public AgencyService $service)
    {
    }

    public function index()
    {
        $agencies = $this->service->getByUserId(auth()->id());
        if (empty($agencies)) {
            return response()->json(['message' => 'No agencies found'], 404);
        } else {
            return response()->json(AgencyResource::collection($agencies), 200);
        }
    }

    public function store(Request $request)
    {
    }

    public function show(Agency $agency)
    {
    }

    public function update(Request $request, Agency $agency)
    {
    }

    public function destroy(Agency $agency)
    {
    }
}
