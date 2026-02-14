<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (auth()->user()->role === 'superadmin') {
            return [
                'email' => 'required|email',
                'role' => 'required|in:admin',
                'company' => 'required',
            ];
        }

        if (auth()->user()->role === 'admin') {
            return [
                'email' => 'required|email',
                'role' => 'required|in:admin,member',
            ];
        }
    }
}
