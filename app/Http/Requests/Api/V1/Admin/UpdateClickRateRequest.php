<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClickRateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'service_id' => ['nullable', 'exists:services,id'],
            'click_rate_type_id' => ['required', 'exists:click_rate_types,id'],
            'agency_id' => ['nullable', 'exists:agencies,id'],
            'contract_type' => ['nullable'],
            'rate' => ['required', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
