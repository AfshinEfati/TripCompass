<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateFlightTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_en' => ['required','unique:flight_types,name_en'],
            'name_fa' => ['required','unique:flight_types,name_fa'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
