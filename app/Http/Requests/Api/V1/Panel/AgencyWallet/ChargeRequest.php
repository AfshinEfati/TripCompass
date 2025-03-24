<?php

namespace App\Http\Requests\Api\V1\Panel\AgencyWallet;

use Illuminate\Foundation\Http\FormRequest;

class ChargeRequest extends FormRequest
{


    public function rules(): array
    {
        return [
            'amount' => [
                'required',
                'numeric',
                'min:10000',
                function ($attribute, $value, $fail) {
                    if ($value > auth()->user()->balance) {
                        $fail('Requested amount exceeds your current balance.');
                    }
                }
            ],
            'agency_id' => [
                'required',
                'exists:agencies,id',
                function ($attribute, $value, $fail) {
                    $user = auth()->user();
                    if (!$user->agencies()->where('id', $value)->exists()) {
                        $fail('The selected agency does not belong to you.');
                    }
                }
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
