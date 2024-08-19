<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
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
            'password' => [
                'required',
                'string',
                'min:6', // Độ dài tối thiểu là 8 ký tự
                'regex:/[a-z]/', // Phải chứa ít nhất một chữ thường    
                'regex:/[A-Z]/', // Phải chứa ít nhất một chữ hoa
                'regex:/[0-9]/', // Phải chứa ít nhất một số
                'confirmed',
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.regex' => 'Mật khẩu phải chứa cả chữ hoa, chữ thường, và số.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ];
    }
}
