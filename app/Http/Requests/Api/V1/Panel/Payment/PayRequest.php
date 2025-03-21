<?php

namespace App\Http\Requests\Api\V1\Panel\Payment;

use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
{

    protected function prepareForValidation(): void
    {
        $this->merge([
            'amount' => (int) $this->amount,
            'user_id' => auth()->id(),
        ]);
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:10000',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
