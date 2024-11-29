<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_en' => ['required'],
            'name_fa' => ['required'],
            'country_id' => ['required', 'exists:countries,id'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
