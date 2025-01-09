<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Admin\AirportResource;
use App\Http\Resources\Api\Admin\SeoResource;
use App\Services\AirportService;
use App\Services\SeoService;
use App\Traits\StatusTrait;

class FrontendController extends Controller
{
    use StatusTrait;

    public function __construct(public SeoService $seoService,public AirportService $airportService)
    {
    }

    public function getByCanonicalUrl(string $canonicalUrl)
    {

        $page = $this->seoService->getByCanonical($canonicalUrl);
        if (!$page) {
            return $this->notFoundResponse(null, 'Page not found');
        }
        return $this->successResponse(SeoResource::make($page), 'Page found');
    }
    public function getAirports($query = null)
    {
        $airports = $this->airportService->getAirports($query);
        return $this->successResponse(AirportResource::collection($airports), 'Airports found');
    }

}
