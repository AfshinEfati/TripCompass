<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateContentRequest;
use App\Http\Resources\Api\Admin\ContentResource;
use App\Models\Content;
use App\Services\ContentService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    use StatusTrait;
    public function __construct(public ContentService $service)
    {
    }

    public function index()
    {
        $contents = $this->service->all();
        return $this->successResponse(ContentResource::collection($contents), 'Content List');
    }

    public function store(CreateContentRequest $request)
    {
        $data = $request->validated();
        $content = $this->service->store($data);
        return $this->successResponse(new ContentResource($content), 'Content Created', 201);
    }

    public function show(Content $content)
    {

    }

    public function update(Request $request, Content $content)
    {
    }

    public function destroy(Content $content)
    {
    }
}
