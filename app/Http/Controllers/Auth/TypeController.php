<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SongRequest;
use App\Http\Requests\TSRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Song_type;
use App\Models\Singer;
use Illuminate\Database\QueryException;

class TypeController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
        $types = Song_type::all();
        $template = 'type.index';
        $config['seo'] = config('apps.types');
        return view('dashboard/layout', compact(
            'template',
            'config',
            'types'
        ))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function store(Request $request)
    {
        if ($request->input('typeName') == null || $request->input('typeName') == '') {
            return redirect()->back()->with('message', 'Tên thể loại không được để trống')->with('type', 'error');
        }
        $type = new Song_type();
        $type->type_name = $request->input('typeName');
        $type->save();
        return redirect()->back()->with('message', 'Thêm thể loại thành công')->with('type', 'success');
    }
    public function update(Request $request, $id)
    {
        if ($request->input('typeName') == null || $request->input('typeName') == '') {
            return redirect()->back()->with('message', 'Tên thể loại không được để trống')->with('type', 'error');
        }
        $type = Song_type::find($id);
        $type->type_name = $request->input('typeName');
        $type->save();
        return redirect()->back()->with('message', 'Thêm thể loại thành công')->with('type', 'success');
    }

    public function delete($id)
    {
        $type = Song_type::findOrFail($id);
        try {
            $type->delete();
            return redirect()->route('type.index')->with('message', 'Xóa thành công')->with('type', 'success');
        } catch (QueryException $e) {
            // Kiểm tra lỗi ràng buộc khóa ngoại
            if ($e->getCode() == '23000') {
                return redirect()->route('type.index')->with('message', 'Không thể xóa thể loại này vì có dữ liệu liên quan')->with('type', 'error');
            }
    
            // Xử lý các lỗi khác (nếu có)
            return redirect()->route('type.index')->with('message', 'Đã xảy ra lỗi không xác định')->with('type', 'error');
        }
    }
}
