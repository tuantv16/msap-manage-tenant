<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResetUserPassword extends FormRequest
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
        return [
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages(): array{
        return [
            'password.required' => 'Password is required',
            'confirm_password.required' => 'Confirm Password is required',
            'confirm_password.same' => 'Confirm Password does not match',
        ];
    }
}
