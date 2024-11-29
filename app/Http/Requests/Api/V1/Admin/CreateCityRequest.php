<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_en' => ['required', 'string', 'unique:cities,name_en'],
            'name_fa' => ['required', 'string', 'unique:cities,name_fa'],
            'state_id' => ['required', 'exists:states,id'],
            'is_active' => ['boolean', 'nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
