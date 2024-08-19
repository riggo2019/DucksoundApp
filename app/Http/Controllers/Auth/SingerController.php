<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TSRequest;
use App\Helpers\StringHelper;
use App\Models\Singer;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class SingerController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
        $singers = Singer::all();
        $template = 'singer.index';
        $config = [
            'seo' => config('apps.singers')
        ];
        return view('dashboard/layout', compact(
            'template',
            'config',
            'singers'
        ))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function store(Request $request)
    {
        $singer = new Singer();
        $singer->singer_name = $request->input('singer_name');
        if ($request->hasFile('singer_image')) {
            if ($file = $request->file('singer_image')) {
                $extension = $file->getClientOriginalExtension();
                $filename = StringHelper::convertToSlug($request->input('singer_name')) . '.' . $extension;
                $file->move(public_path('images/singer'), $filename);
                $singer->singer_image = $filename;
            } else {
                return back()->with('message', 'Hình ảnh không hợp lệ.')->with('type', 'error');
            }
        }
        $singer->save();
        return redirect()->route('singer.index')->with('message', 'Thêm ca sĩ thành công')->with('type', 'success');
    }

    public function update(Request $request, $id)
    {
        $singer = Singer::find($id);
        $singer->singer_name = $request->input('singer_name');
        
        if ($request->hasFile('singer_image')) {
            $oldfile = asset('images/singer/' . $singer->singer_image);
            if (File::exists($oldfile)) {
                File::delete($oldfile);
            }
            if ($file = $request->file('singer_image')) {
                $extension = $file->getClientOriginalExtension();
                $filename = StringHelper::convertToSlug($request->input('singer_name')) . '.' . $extension;
                $file->move(public_path('images/singer'), $filename);
                $singer->singer_image = $filename;
            } else {
                return back()->with('message', 'File không hợp lệ.')->with('type', 'error');
            }
        }
        $singer->save();
        return redirect()->route('singer.index')->with('message', 'Cập nhật ca sĩ thành công')->with('type', 'success');
    }
    public function delete($id)
    {
        $singer = Singer::findOrFail($id);
        try {
            $singer->delete();
            return redirect()->route('singer.index')->with('message', 'Xóa thành công')->with('type', 'success');
        } catch (QueryException $e) {
            // Kiểm tra lỗi ràng buộc khóa ngoại
            if ($e->getCode() == '23000') {
                return redirect()->route('singer.index')->with('message', 'Không thể xóa ca sĩ này vì có dữ liệu liên quan')->with('type', 'error');
            }

            // Xử lý các lỗi khác (nếu có)
            return redirect()->route('singer.index')->with('message', 'Đã xảy ra lỗi không xác định')->with('type', 'error');
        }
    }
}
