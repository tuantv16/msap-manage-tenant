<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        //check except current user email
        $userId = $this->route('id');
        return [
            'email' => 'required|email|unique:users,email,' . $userId,
            'name' => 'required',
            'roles' => 'required|array',
        ];
    }
    public function messages(): array{
        return [
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'confirm_password.required' => 'Confirm Password is required',
            'confirm_password.same' => 'Confirm Password does not match',
            'name.required' => 'Name is required',
            'roles.required' => 'Role is required',
            'roles.array' => 'Role must be an array',
        ];
    }
}
