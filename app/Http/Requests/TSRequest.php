<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TSRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type_name' => 'required|unique:song_type',
            'singer_name' => 'required|unique:singer',
        ];
    }
    public function messages(): array
    {
        return [
            'type_name.required' => 'Vui lòng nhập tên thể loại',
            'type_name.unique' => 'Thể loại đã tồn tại',
            'singer_name.required' => 'Vui lòng nhập tên ca sĩ',
            'singer_name.unique' => 'Ca sĩ này đã tồn tại',
        ];
    }
}
