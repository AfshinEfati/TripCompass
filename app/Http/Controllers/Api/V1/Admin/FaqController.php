<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateFaqRequest;
use App\Http\Requests\Api\V1\Admin\UpdateFaqRequest;
use App\Http\Resources\Api\Admin\FaqResource;
use App\Models\Faq;
use App\Services\FaqService;
use App\Traits\StatusTrait;
use Illuminate\Http\JsonResponse;

class FaqController extends Controller
{
    use StatusTrait;

    public function __construct(public FaqService $service)
    {
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function index($id): JsonResponse
    {
        $faqs = $this->service->all($id);
        return $this->successResponse(FaqResource::collection($faqs), 'Faq list');
    }

    /**
     * @param CreateFaqRequest $request
     * @return JsonResponse
     */
    public function store(CreateFaqRequest $request): JsonResponse
    {
        $faq = $this->service->store($request->validated());
        return $this->successResponse(FaqResource::make($faq), 'Faq created successfully.');
    }


    public function update(UpdateFaqRequest $request, int $seo_id, int $faq_id): JsonResponse
    {
        $this->service->update($request->validated(), $faq_id);
        $faq = $this->service->findById($faq_id);
        return $this->successResponse(FaqResource::make($faq), 'Faq updated successfully.');
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->destroy($id);
        return $this->successResponse(null, 'Faq deleted successfully.');
    }
}
