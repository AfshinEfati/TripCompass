<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAgencyServiceRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $agencyId = $this->route('agency_id');
        $this->merge([
            'agency_id' => $agencyId,
        ]);
    }

    public function rules(): array
    {
        return [
            'agency_id'=>'required|exists:agencies,id',
            'service_id'=>'required|exists:services,id',
            'vendor'=>'required|string',
            'config'=>'nullable|array',
            'daily_request_limit'=>'nullable|integer',
            'min_update_interval'=>'nullable|integer',
            'no_route_restriction'=>'nullable|boolean',
            'is_active'=>'nullable|boolean',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
