<?php

namespace App\Http\Requests\Api\V1\Admin;

use App\Models\Agency;
use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;

class CreateAgencyServiceRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $agencyId = $this->route('agency')->id;
        $agency = Agency::find($agencyId);
        $service = Service::find($this->service_id);
        $name = ucfirst($agency->name_en) . ucfirst($service->name_en);
        $this->merge([
            'agency_id' => (int)$agencyId,
            'vendor' => $name
        ]);
    }

    public function rules(): array
    {
        return [
            'agency_id' => 'required|exists:agencies,id',
            'service_id' => 'required|exists:services,id',
            'vendor' => 'required|string',
            'config' => 'nullable|array',
            'daily_request_limit' => 'nullable|integer',
            'min_update_interval' => 'nullable|integer',
            'no_route_restriction' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
