<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAirlineRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route('airline')->id;
        return [
            'name_en' => ['required', 'unique:airlines,name_en,' . $id],
            'name_fa' => ['required', 'unique:airlines,name_fa,' . $id],
            'iata_code' => ['nullable', 'unique:airlines,iata_code,' . $id],
            'icao_code' => ['nullable', 'unique:airlines,icao_code,' . $id],
            'country_id' => ['required', 'exists:countries,id'],
            'logo_url' => ['nullable'],
            'is_active' => ['boolean', 'nullable'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
