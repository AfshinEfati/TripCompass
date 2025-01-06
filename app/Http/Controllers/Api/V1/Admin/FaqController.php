<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\CreateFaqRequest;
use App\Http\Requests\Api\Admin\UpdateFaqRequest;
use App\Http\Resources\Api\Admin\FaqResource;
use App\Models\Faq;
use App\Services\FaqService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    use StatusTrait;

    public function __construct(public FaqService $service)
    {
    }

    public function index($id)
    {
        $faqs = $this->service->all($id);
        return $this->successResponse(FaqResource::collection($faqs), 'Faq list');
    }

    public function store(CreateFaqRequest $request)
    {
        $faq = $this->service->store($request->validated());
        return $this->successResponse(FaqResource::make($faq), 'Faq created successfully.');
    }


    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $this->service->update($request->validated(), $faq->id);
        return $this->successResponse(null, 'Faq updated successfully.');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return $this->successResponse(null, 'Faq deleted successfully.');
    }
}
