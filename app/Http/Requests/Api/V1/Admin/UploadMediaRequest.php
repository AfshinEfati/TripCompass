<?php

namespace App\Http\Requests\Api\V1\Admin;

use App\Models\Seo;
use Illuminate\Foundation\Http\FormRequest;

class UploadMediaRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        $this->merge([
            'model_id' => $this->route('seo'),
            'model_type' => Seo::class,
        ]);
    }

    public function rules(): array
    {
        $model_type = Seo::class;
        return [
            'files' => 'required|array',
            'files.*' => 'file|mimes:jpeg,jpg,png,gif,svg|max:2048',
           'model_id' => 'required|integer|exists:' . $model_type . ',id',
            'model_type' => 'required|string|in:' . $model_type,
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
