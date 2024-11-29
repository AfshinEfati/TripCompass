<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateStateRequest;
use App\Http\Requests\Api\V1\Admin\UpdateStateRequest;
use App\Http\Resources\Api\Admin\StateResource;
use App\Models\State;
use App\Services\StateService;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function __construct(public StateService $service)
    {
    }

    public function index()
    {
        $states = $this->service->all();
        return response()->json([
            'success' => true,
            'data' => StateResource::collection($states),
            'message' => 'Get states success'
        ]);
    }

    public function store(CreateStateRequest $request)
    {
        $state = $this->service->store($request->validated());
        return response()->json([
            'success' => true,
            'data' => StateResource::make($state),
            'message' => 'Create state success'
        ]);
    }

    public function show(State $state)
    {
        return response()->json([
            'success' => true,
            'data' => StateResource::make($state),
            'message' => 'Get state success'
        ]);
    }

    public function update(UpdateStateRequest $request, State $state)
    {
        $state = $this->service->update($request->validated(), $state);
        return response()->json([
            'success' => true,
            'data' => StateResource::make($state),
            'message' => 'Update state success'
        ]);
    }

    public function destroy(State $state)
    {
        $this->service->destroy($state);
        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'State Delete successfully'
        ]);
    }
}
