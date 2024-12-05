<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgencyRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route('agency')->id;
        return [
            'name_en' => ['required', 'unique:agencies,name_en,' . $id],
            'name_fa' => ['nullable', 'unique:agencies,name_fa,' . $id],
            'base_url' => ['required', 'url', 'unique:agencies,base_url,' . $id],
            'contract_type' => ['required', 'in:fixed,percentage'],
            'commission_rate' => ['required_if:contract_type,percentage', 'integer', 'min:0', 'max:100'],
            'fixed_rate' => ['required_if:contract_type,fixed', 'integer', 'min:0'],
            'user_id' => ['required', 'exists:users,id'],
            'is_active' => ['boolean', 'nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
