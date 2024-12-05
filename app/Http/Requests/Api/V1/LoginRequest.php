<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $numericMobile = preg_replace('/[^0-9]/', '', $this->request->get('mobile'));

        if (strlen($numericMobile) >= 11) {
            if (str_starts_with($numericMobile, '0')) {
                $numericMobile= (int)ltrim(substr($numericMobile, 1), '0');
            } elseif (str_starts_with($numericMobile, '98')) {
                $numericMobile= (int)ltrim(substr($numericMobile, 2), '0');
            }
        }

        $this->merge(['mobile' => $numericMobile]);

    }

    public function rules(): array
    {

        return [
            'mobile' => 'required|numeric|digits:10',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
