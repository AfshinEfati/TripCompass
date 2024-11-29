<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
{
    public function rules(): array
    {
        $countryId = $this->route('country')->id ?? $this->route('country');
        return [
            'name_en' => ['required', 'unique:countries,name_en,' . $countryId],
            'name_fa' => ['required', 'unique:countries,name_fa,' . $countryId],
            'title_fa' => ['nullable'],
            'iso_code' => ['nullable', 'unique:countries,iso_code,' . $countryId],
            'iso_code_3' => ['nullable', 'unique:countries,iso_code_3,' . $countryId],
            'is_active' => ['boolean', 'nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
