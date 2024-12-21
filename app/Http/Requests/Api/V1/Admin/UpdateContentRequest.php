<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
//            'id' => ['required', 'exists:contents,id'],
            'seo_id' => ['nullable', 'exists:seos,id'],
            'title_fa' => ['required'],
            'content' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
