<?php

namespace App\Http\Requests\Api\V1\Panel\Provider;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:150',
            'email' => 'required|email|unique:providers,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
