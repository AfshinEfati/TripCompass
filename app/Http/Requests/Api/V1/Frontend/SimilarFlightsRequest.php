<?php

namespace App\Http\Requests\Api\V1\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class SimilarFlightsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'flight_key'=>['required','exists:flights,flight_key']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
