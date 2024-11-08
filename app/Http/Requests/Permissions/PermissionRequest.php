<?php

namespace App\Http\Requests\Permissions;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
    public function rules()
    {
        $method = $this->method();

        if ($method == 'POST') {
            return [
                'name' => 'required|string|max:255|unique:permissions,name',
                'description' => 'nullable|string',
            ];
        } elseif (in_array($method, ['PUT', 'PATCH'])) {
            return [
                'name' => 'required|string|max:255|unique:permissions,name,' . $this->route('id'),
                'description' => 'nullable|string',
            ];
        }

        return [];
    }
}
