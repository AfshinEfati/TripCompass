<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCabinRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route('cabin')->id;
        return [
            'name_en' => ['required', 'unique:cabins,name_en,' . $id],
            'name_fa' => ['required', 'unique:cabins,name_fa,' . $id],
            'code' => ['required', 'unique:cabins,code,' . $id],
            'number' => ['required', 'unique:cabins,number,' . $id],
            'status' => ['nullable', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
