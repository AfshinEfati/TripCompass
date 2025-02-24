<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Admin\AirportResource;
use App\Http\Resources\Api\Admin\SeoResource;
use App\Services\AirportService;
use App\Services\SeoService;
use App\Traits\StatusTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    use StatusTrait;

    public function __construct(public SeoService $seoService, public AirportService $airportService)
    {
    }

    public function getByCanonicalUrl(Request $request): JsonResponse
    {
        $canonicalUrl = $request->canonicalUrl;

        $page = $this->seoService->getByCanonical($canonicalUrl);
        if (!$page) {
            return $this->notFoundResponse(null, 'Page not found');
        }
        return $this->successResponse(SeoResource::make($page), 'Page found');
    }

    public function getAirports(Request $request): JsonResponse
    {
        $airports = $this->airportService->getAirports($request->input('query'));
        return $this->successResponse(AirportResource::collection($airports), 'Airports found');
    }

}
