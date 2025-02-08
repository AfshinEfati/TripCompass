<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAgencyServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'agency_id' => ['required', 'exists:agencies,id'],
            'service_id' => ['required', 'exists:services,id'],
            'config' => ['nullable', 'array'],
            'is_active' => ['boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
