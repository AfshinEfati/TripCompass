<?php

namespace App\Http\Requests\Api\V1\Panel\Contract;

use Illuminate\Foundation\Http\FormRequest;

class CreateContractRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }

    public function rules(): array
    {
        return [
            'agency_id' => 'required|exists:agencies,id',
            'user_id' => 'required|exists:users,id',
            'contract_type' => 'required|string|in:CPC,CPA,subscription',
            'license_number' => 'required|string',
            'company_registration_number' => 'required|string',
            'national_id' => 'required|string',
            'economic_code' => 'required|string',
            'contact_person' => 'required|string',
            'contact_national_id' => 'required|string',
            'contact_phone' => 'required|string',
            'contact_email' => 'required|email',
            'bank_account' => 'nullable|string',
            'bank_shaba' => 'nullable|string|size:24',
            'bank_id' => 'required|exists:banks,id',
            'files' => 'required|array',
            'files.*.file_type' => 'required|string',
            'files.*.file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
