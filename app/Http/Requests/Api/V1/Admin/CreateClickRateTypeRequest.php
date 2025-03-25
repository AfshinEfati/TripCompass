<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateClickRateTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required', 'unique:click_rate_types,code'],
            'title' => ['required', 'string'],
            'rule' => ['nullable', 'string'],
            'is_active' => ['boolean', 'nullable'],
            'sort_order' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
