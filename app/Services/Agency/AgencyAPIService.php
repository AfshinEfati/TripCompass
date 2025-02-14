<?php

namespace App\Services\Agency;

use App\Models\AgencyService;

class AgencyAPIService
{
    public function getAgencyConfig($agencyId, $serviceId)
    {
        $service = AgencyService::where('agency_id', $agencyId)
            ->where('service_id', $serviceId)
            ->first();

        return $service ? json_decode($service->config, true) : null;
    }
}
