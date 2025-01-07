<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnchorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'seo_id' => ['required', 'exists:seos,id'],
            'url' => ['required'],
            'title' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
