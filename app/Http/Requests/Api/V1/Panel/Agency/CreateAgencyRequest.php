<?php

namespace App\Http\Requests\Api\V1\Panel\Agency;

use Illuminate\Foundation\Http\FormRequest;

class CreateAgencyRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->id(),
            'status'=>false
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'name_en' => ['required', 'string', 'max:255', 'unique:agencies,name_en'],
            'name_fa' => ['required', 'string', 'max:255', 'unique:agencies,name_fa'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
