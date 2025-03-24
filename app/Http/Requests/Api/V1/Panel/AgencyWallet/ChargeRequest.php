<?php

namespace App\Http\Requests\Api\V1\Panel\AgencyWallet;

use Illuminate\Foundation\Http\FormRequest;

class ChargeRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'balance' => auth()->user()->balance,
        ]);
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:10000',
            'balance' => 'required|numeric|balance>=amount',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
