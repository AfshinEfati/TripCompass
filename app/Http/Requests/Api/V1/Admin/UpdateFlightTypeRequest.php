<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFlightTypeRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route('flight_type')->id;
        return [
            'name_en' => ['required', 'unique:flight_types,name_en,' . $id],
            'name_fa' => ['required', 'unique:flight_types,name_fa,' . $id],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
