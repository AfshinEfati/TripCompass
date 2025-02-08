<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateAgencyServiceRequest;
use App\Http\Requests\Api\V1\Admin\UpdateAgencyServiceRequest;
use App\Models\AgencyService;
use App\Services\AgencyServiceService;
use Illuminate\Http\Request;

class AgencyServiceController extends Controller
{
    public function __construct(public AgencyServiceService $service)
    {

    }

    public function index()
    {

    }
    public function getByAgencyId($agencyId)
    {
        return $this->service->getByAgencyId($agencyId);
    }
    public function store(CreateAgencyServiceRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function show(AgencyService $agencyService)
    {
    }

    public function update(UpdateAgencyServiceRequest $request, AgencyService $agencyService)
    {
        return $this->service->update($agencyService, $request->validated());
    }

    public function destroy(AgencyService $agencyService)
    {
        return $this->service->destroy($agencyService);
    }
}
