<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route('service')->id;
        return [
            'name_en' => ['required','unique:services,name_en,'.$id],
            'name_fa' => ['required','unique:services,name_fa,'.$id],
            'is_active' => ['boolean','nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
