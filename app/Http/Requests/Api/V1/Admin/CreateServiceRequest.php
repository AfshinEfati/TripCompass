<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_en' => ['required','unique:services,name_en'],
            'name_fa' => ['required','unique:services,name_fa'],
            'is_active' => ['boolean','nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
