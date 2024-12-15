<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeoRelationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'seo_id' => ['required', 'exists:seos,id'],
            'model_id' => ['required', 'integer'],
            'model_type' => ['required'],
            'relation_type' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
