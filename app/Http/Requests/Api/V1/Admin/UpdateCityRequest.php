<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route('city')->id ?? $this->route('city');
        return [
            'name_en' => ['required', 'string', 'unique:cities,name_en,'. $id],
            'name_fa' => ['required', 'string', 'unique:cities,name_fa,'. $id],
            'state_id' => ['required', 'exists:states,id'],
            'is_active' => ['boolean', 'nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
