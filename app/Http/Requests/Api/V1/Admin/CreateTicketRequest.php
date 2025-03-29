<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'agency_id' => 'nullable|exists:agencies,id',
            'receiver_user_id' => 'nullable|exists:users,id',
            'type' => 'required|string|in:system_to_agency,admin_to_user,user_to_admin,admin_to_agency,system',
            'is_public' => 'boolean',
            'message' => 'required|string',
            'status'=>'nullable|string|in:open,pending,answered,closed',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
