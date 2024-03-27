<?php

namespace App\Http\Requests\User\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth('api')->user();
        return $user->isAbleTo(['user-superuser-create', 'user-admin-create', 'user-license-create']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|unique:user,username|max:255',
            'email' => 'sometimes|email|unique:user,email|max:255',
            'password' => 'required|min:8',
            'role' => 'required|in:superuser,admin',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Bidang nama wajib diisi.',
            'username.required' => 'Bidang username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Bidang email wajib diisi.',
            'email.email' => 'Harap masukkan alamat email yang valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Bidang password wajib diisi.',
            'password.min' => 'Password harus memiliki setidaknya :min karakter.',
        ];
    }
}
