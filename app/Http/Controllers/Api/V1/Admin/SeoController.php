<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateSeoRequest;
use App\Http\Requests\Api\V1\Admin\UpdateSeoRequest;
use App\Http\Requests\Api\V1\Admin\UploadMediaRequest;
use App\Http\Resources\Api\Admin\MediaResource;
use App\Http\Resources\Api\Admin\SeoResource;
use App\Models\Seo;
use App\Services\MediaService;
use App\Services\SeoService;
use App\Traits\StatusTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    use StatusTrait;
    public function __construct(public SeoService $service, public MediaService $mediaService)
    {
    }

    public function index(): JsonResponse
    {
        $seos = $this->service->all();
        return $this->successResponse(SeoResource::collection($seos), 'All Seo');

    }

    public function store(CreateSeoRequest $request): JsonResponse
    {
        $seo = $this->service->store($request->validated());
        return $this->successResponse(new SeoResource($seo), 'Seo Created');
    }

    public function show(Seo $seo): JsonResponse
    {
        $seo = $this->service->findWithAll($seo);
        return $this->successResponse(new SeoResource($seo), 'Seo Detail');
    }

    public function update(UpdateSeoRequest $request, Seo $seo): JsonResponse
    {
        $seo = $this->service->update($request->validated(), $seo);
        return $this->successResponse(new SeoResource($seo), 'Seo Updated');
    }

    public function destroy(Seo $seo): JsonResponse
    {
        $this->service->delete($seo);
        return $this->successResponse(null, 'Seo Deleted');
    }
    public function upload(UploadMediaRequest $request): JsonResponse
    {
        $documents = $this->mediaService->upload($request->validated());
        return $this->successResponse(MediaResource::collection($documents), 'Media Uploaded');
    }
}
