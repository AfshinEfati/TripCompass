<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAirportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_en' => ['nullable','unique:airports,name_en'],
            'name_fa' => ['nullable','unique:airports,name_fa'],
            'iata_code' => ['nullable','unique:airports,iata_code','max:3'],
            'icao_code' => ['nullable','unique:airports,icao_code','max:4'],
            'city_id' => ['required', 'exists:cities,id'],
            'is_popular' => ['boolean','nullable'],
            'is_active' => ['boolean','nullable'],
            'foreign_flight' => ['boolean','nullable'],
            'domestic_flight' => ['boolean','nullable'],
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}
