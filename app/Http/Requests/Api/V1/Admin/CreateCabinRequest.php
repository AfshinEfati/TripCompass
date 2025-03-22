<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCabinRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_en' => ['required', 'unique:cabins,name_en'],
            'name_fa' => ['required', 'unique:cabins,name_fa'],
            'code' => ['required', 'unique:cabins,code'],
            'number' => ['required', 'unique:cabins,number'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
