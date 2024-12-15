<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateSeoRelationRequest;
use App\Http\Requests\Api\V1\Admin\UpdateSeoRelationRequest;
use App\Http\Resources\Api\Admin\SeoRelationResource;
use App\Models\SeoRelation;
use App\Services\SeoRelationService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class SeoRelationController extends Controller
{
    use StatusTrait;

    public function __construct(public SeoRelationService $service)
    {
    }

    public function index()
    {

    }

    public function store(CreateSeoRelationRequest $request)
    {
        $seoRelation = $this->service->store($request->validated());
        return $this->successResponse(SeoRelationResource::make($seoRelation), 'Seo Relation created successfully');
    }

    public function show(SeoRelation $seoRelation)
    {
        return $this->successResponse(SeoRelationResource::make($seoRelation), 'Seo Relation fetched successfully');
    }

    public function update(UpdateSeoRelationRequest $request, SeoRelation $seoRelation)
    {
        $seoRelation = $this->service->update($seoRelation, $request->validated());
        return $this->successResponse(SeoRelationResource::make($seoRelation), 'Seo Relation updated successfully');
    }

    public function destroy(SeoRelation $seoRelation)
    {
        $this->service->delete($seoRelation);
        return $this->successResponse([], 'Seo Relation deleted successfully');
    }
}
