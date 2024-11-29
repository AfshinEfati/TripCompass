<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCountryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_en' => ['required','unique:countries,name'],
            'name_fa' => ['required','unique:countries,name_fa'],
            'title_fa' => ['nullable'],
            'iso_code' => ['nullable','unique:countries,iso_code'],
            'iso_code_3' => ['nullable','unique:countries,iso_code_3'],
            'is_active' => ['boolean','nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
