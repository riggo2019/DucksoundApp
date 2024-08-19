<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongRequest extends FormRequest
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
            'song_name' => 'required',
            'type_id' => 'required',
            'singer_id' => 'required',
            'nation' => 'required',
            'song_file' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'song_name.required' => 'Vui lòng nhập tên người dùng',
            'type_id.required' => 'Thể loại không được để trống',
            'singer_id.required' => 'Ca sĩ không được để trống',
            'nation.required' => 'Quốc gia không được để trống',
            'song_file.required' => 'File âm thanh không được để trống',
        ];
    }
}
