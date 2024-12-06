<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAirlineRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_en' => ['required','unique:airlines,name_en'],
            'name_fa' => ['required','unique:airlines,name_fa'],
            'iata_code' => ['nullable','unique:airlines,iata_code'],
            'icao_code' => ['nullable','unique:airlines,icao_code'],
            'country_id' => ['required', 'exists:countries,id'],
            'logo_url' => ['nullable'],
            'is_active' => ['boolean','nullable'],
            'description' => ['nullable','string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
