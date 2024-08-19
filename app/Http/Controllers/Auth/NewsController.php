<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\News;
use App\Http\Requests\NewsRequest;
use App\Helpers\StringHelper;

class NewsController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {

        $news = DB::table('news')
            ->when($request->keyword !== null, function ($row) use ($request) {
                return $row->where('title', 'LIKE', '%' . $request->keyword . '%')->orWhere('description', 'LIKE', '%' . $request->keyword . '%');
            })
            ->paginate(5);
        $template = 'news.index';
        $config = [
            'js' => [
                asset('/template/js/plugins/switchery/switchery.js')
            ],
            'css' => [
                asset('/template/css/plugins/switchery/switchery.css'),
            ],
            'seo' => config('apps.news')
        ];

        return view('dashboard/layout', compact(
            'template',
            'config',
            'news',
        ))->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function create()
    {
        $template = 'news.create';
        $config['seo'] = config('apps.news');
        return view('dashboard/layout', compact(
            'template',
            'config',
        ));
    }

    public function store(NewsRequest $request)
    {

        $news = new News();
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        if ($file = $request->file('news_image')) {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('images/news'), $filename);
            $news->news_image = $filename;
        }

        $news->save();
        return redirect()->back()->with('message', 'Thêm tin tức thành công')->with('type', 'success');
    }

    public function edit($id)
    {
        $news =  News::find($id);
        $template = 'news.edit';
        $config['seo'] = config('apps.news');
        return view('dashboard/layout', compact(
            'template',
            'config',
            'news'
        ));
    }

    public function update(NewsRequest $request, $id)
    {

        $news = News::find($id);
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        if ($request->hasFile('news_image')) {
            $oldfile = asset('images/news/' . $news->news_image);
            if (File::exists($oldfile)) {
                File::delete($oldfile);
            }
            if ($file = $request->file('news_image')) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('images/news'), $filename);
                $news->news_image = $filename;
            }else {
                return back()->with('message', 'File không hợp lệ.')->with('type', 'error');
            }
        }

        $news->update();
        return redirect()->back()->with('message', 'Cập nhật tin tức thành công')->with('type', 'success');
    }
    public function delete($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('news.index')->with('message', 'Xóa tin tứcthành công')->with('type', 'success');
    }
}
