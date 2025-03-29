<?php

namespace App\Http\Requests\Api\V1\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class AvailabilityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'origin' => ['required', 'string', 'max:3', 'exists:airports,iata_code'],
            'destination' => ['required', 'string', 'max:3', 'exists:airports,iata_code'],
            'date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:today'],
            'trip_type' => ['required', 'in:one_way,rounded'],
            'return_date' => ['required_if:trip_type,rounded', 'date', 'after_or_equal:date', 'date_format:Y-m-d'],
            'cabin_type'=>['nullable'],
            'flight_type'=>['nullable','in:system,charter'],
            'airline_id'=>['nullable','exists:airlines,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
