<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAgencyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'name_en' => ['required', 'string', 'max:255', 'unique:agencies,name_en'],
            'name_fa' => ['required', 'string', 'max:255', 'unique:agencies,name_fa'],
            'is_active' => ['boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
