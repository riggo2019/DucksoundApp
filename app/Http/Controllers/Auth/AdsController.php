<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {

        $ads = DB::table('ads')
            ->when($request->keyword !== null, function ($row) use ($request) {
                return $row->where('ads_name', 'LIKE', '%' . $request->keyword . '%');
            })
            ->paginate(5);
        $template = 'ads.index';
        $config = [
            'js' => [
            ],
            'css' => [
            ],
            'seo' => config('apps.ads')
        ];

        return view('dashboard/layout', compact(
            'template',
            'config',
            'ads',
        ))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function create()
    {
        $template = 'ads.create';
        $config['seo'] = config('apps.ads');
        return view('dashboard/layout', compact(
            'template',
            'config',
        ));
    }

    public function store(Request $request)
    {

        $ads = new Ads();
        $ads->ads_name = $request->input('ads_name');
        $ads->description = $request->input('description');

        if ($request->hasFile('ads_file')) {
            if ($file = $request->file('ads_file')) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('storage/ads_file'), $filename);
                $ads->ads_file = $filename;
            } else {
                return back()->with('message', 'File âm thanh không hợp lệ.')->with('type', 'error');
            }
        } else {
            return back()->with('message', 'Không tìm thấy file âm thanh.')->with('type', 'error');
        }
        if ($request->hasFile('ads_image')) {
            if ($file = $request->file('ads_image')) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('images/ads/'), $filename);
                $ads->ads_image = $filename;
            } else {
                return back()->with('message', 'File hình ảnh không hợp lệ.')->with('type', 'error');
            }
        }
        $ads->owner_company = $request->input('owner_company');

        $ads->save();
        return redirect()->back()->with('message', 'Thêm quảng cáo thành công')->with('type', 'success');
    }

    public function edit($id)
    {
        $ads =  Ads::find($id);
        $template = 'ads.edit';
        $config['seo'] = config('apps.ads');
        return view('dashboard/layout', compact(
            'template',
            'config',
            'ads'
        ));
    }

    public function update(Request $request, $id)
    {

        $ads = Ads::find($id);
        
        $ads->ads_name = $request->input('ads_name');
        $ads->description = $request->input('description');
        if ($request->hasFile('ads_file')) {
            $oldfile = asset('storage/ads_file/' . $ads->ads_file);
            if (File::exists($oldfile)) {
                File::delete($oldfile);
            }
            if ($file = $request->file('ads_file')) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('storage/ads_file'), $filename);
                $ads->ads_file = $filename;
            } else {
                return back()->with('message', 'File không hợp lệ.')->with('type', 'error');
            }
        }
        if ($request->hasFile('ads_image')) {
            $oldfile = asset('images/ads/' . $ads->ads_image);
            if (File::exists($oldfile)) {
                File::delete($oldfile);
            }
            if ($file = $request->file('ads_image')) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('images/ads/'), $filename);
                $ads->ads_image = $filename;
            } else {
                return back()->with('message', 'File không hợp lệ.')->with('type', 'error');
            }
        }
        $ads->owner_company = $request->input('owner_company');
        $ads->update();
        return redirect()->back()->with('message', 'Cập nhật quảng cáo thành công')->with('type', 'success');
    }
    public function delete($id)
    {
        $ads = Ads::findOrFail($id);
        $ads->delete();

        return redirect()->route('ads.index')->with('message', 'Xóa quảng cáo thành công')->with('type', 'success');
    }
}
