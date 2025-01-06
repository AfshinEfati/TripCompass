<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFaqRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'question' => ['required'],
            'answer' => ['required'],
            'seo_id' => ['required', 'exists:seos,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
