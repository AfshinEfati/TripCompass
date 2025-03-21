<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateAnchorRequest;
use App\Http\Requests\Api\V1\Admin\UpdateAnchorRequest;
use App\Http\Resources\Api\Admin\AnchorResource;
use App\Models\Anchor;
use App\Services\AnchorService;
use App\Traits\StatusTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnchorController extends Controller
{
    use StatusTrait;

    public function __construct(public AnchorService $service)
    {
    }

    public function getAnchors($id): JsonResponse
    {
        $anchors = $this->service->allBySeoId($id);
        return $this->successResponse(AnchorResource::collection($anchors), 'Anchors fetched successfully');
    }

    public function storeAnchor(CreateAnchorRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $anchor = $this->service->store($validated);
        return $this->successResponse(new AnchorResource($anchor), 'Anchor created successfully', 201);
    }


    public function updateAnchor(UpdateAnchorRequest $request, int $seo_id, int $anchor_id): JsonResponse
    {
        $validated = $request->validated();
        $anchor = $this->service->update($validated, $anchor_id);
        return $this->successResponse(new AnchorResource($anchor), 'Anchor updated successfully');
    }

    public function destroyAnchor(int $id, int $anchor_id): JsonResponse
    {
        $this->service->destroy($anchor_id);
        return $this->successResponse([], 'Anchor deleted successfully');
    }
}
