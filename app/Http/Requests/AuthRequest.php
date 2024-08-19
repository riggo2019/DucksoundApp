<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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

     //Validate dữ liệu ở form đăng nhập
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập email !',
            'email.email' => 'Vui lòng nhập đúng định dạng email, ví dụ abc@gmail.com',
            'email.exists' => 'Email không tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu !',
        ];
    }
}
