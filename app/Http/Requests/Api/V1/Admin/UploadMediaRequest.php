<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UploadMediaRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        dd($this->route());
        $this->merge([
            'model_id' => $this->route('content'),
            'model_type' => $this->route('model_type'),
        ]);
    }

    public function rules(): array
    {
        $model_id = $this->route('content');
        $model_type = $this->route('model_type');
        return [
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'model_id' => 'required|integer|exists:' . $model_type . ',id',
            'model_type' => 'required|string|in:' . $model_type,
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
