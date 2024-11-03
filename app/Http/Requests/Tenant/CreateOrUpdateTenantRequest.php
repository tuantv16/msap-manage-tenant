<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateTenantRequest extends FormRequest
{
    public function authorize()
    {
        // Ensure the user is authorized to make this request
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:tenants,name,' . $this->route('tenant'),
            'domain' => [
                'required',
                'string',
                'max:255',
                'unique:tenants,domain,' . $this->route('tenant'),
                'regex:/^[a-z0-9]+([-]{1}[a-z0-9]+)*\.[a-z0-9]+(\.[a-z]{2,5})?$/i',
            ],
            'email' => 'required|email|max:255|unique:tenants,email,' . $this->route('tenant'),
            'active' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The tenant name is required.',
            'domain.required' => 'The domain is required.',
            'email.required' => 'A valid email is required.',
            'name.unique' => 'This tenant name is already in use.',
            'domain.unique' => 'This domain is already in use.',
            'email.unique' => 'This email is already in use.',
            'domain.regex' => 'The domain format is invalid. Please enter a valid domain like example.com or example.co.jp.',
        ];
    }
}
