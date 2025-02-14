<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgencyRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route('agency')->id;
        return [
            'user_id' => ['required', 'exists:users,id'],
            'name_en' => ['required', 'string', 'max:255', 'unique:agencies,name_en,'.$id],
            'name_fa' => ['required', 'string', 'max:255', 'unique:agencies,name_fa,'.$id],
            'is_active' => ['boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
