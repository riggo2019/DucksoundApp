<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'fullname' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15|unique:users,phone',
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
            'fullname.required' => 'Vui lòng nhập tên người dùng',
            'fullname.min' => 'Tên người dùng phải có ít nhất 8 ký tự.',
            'email.required' => 'Vui lòng nhập email !',
            'email.email' => 'Vui lòng nhập đúng định dạng email, ví dụ abc@gmail.com',
            'email.unique' => 'Email này đã tồn tại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Vui lòng nhập đúng định dạng số điện thoại, ví dụ 0901234567',
            'phone.unique' => 'Số điện thoại này đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.regex' => 'Mật khẩu phải chứa cả chữ hoa, chữ thường, và số.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ];
    }
}
