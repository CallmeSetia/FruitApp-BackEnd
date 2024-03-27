<?php

namespace App\Http\Requests\User\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth('api')->user();
        return $user->isAbleTo(['user-superuser-update', 'user-admin-update', 'user-license-update']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->request->get('id');

        return [
            'id' => 'required|numeric|exists:user,id',
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'max:255',
                Rule::unique('user', 'username')->ignore($userId),
            ],
            'email' => [
                'sometimes',
                'email',
                Rule::unique('user', 'email')->ignore($userId),
                'max:255',
            ],
//            'password' => 'required|',
            'role' => [
                'required',
                Rule::in(['superuser', 'admin'])
            ]
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
