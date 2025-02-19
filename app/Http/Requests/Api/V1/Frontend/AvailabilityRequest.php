<?php

namespace App\Http\Requests\Api\V1\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class AvailabilityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'origin_id' => ['required', 'integer', 'exists:airports,id'],
            'destination_id' => ['required', 'integer', 'exists:airports,id'],
            'date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:today'],
            'trip_type' => ['required', 'in:one_way,rounded'],
            'return_date' => ['required_if:trip_type,rounded', 'date', 'after_or_equal:date', 'date_format:Y-m-d']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
