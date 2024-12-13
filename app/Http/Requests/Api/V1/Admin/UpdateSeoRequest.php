<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:65',
            'description' => 'required|string|max:255',
            'canonical' => 'required|string|max:255',
            'robots' => 'required|string|max:20',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
