<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\Song_types;
use App\Models\Singer;
use Illuminate\Http\Request;
use App\Http\Requests\SongRequest;
use Illuminate\Support\Facades\DB;
use App\Helpers\StringHelper;
use App\Models\Song_type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;



class SongController extends Controller
{
    public function __construct() {}
    public function index(Request $request)
    {
        $songs = DB::table('songs')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')
            ->orderBy('songs.song_name')
            ->when($request->type !== null && $request->type !== '', function ($row) use ($request) {
                return $row->where('type_id', $request->type);
            })
            ->when($request->keyword !== null, function ($row) use ($request) {
                if ($request->search_type == 0) {
                    return $row->where('song_name', 'LIKE', '%' . $request->keyword . '%');
                } elseif ($request->search_type == 1) {
                    return $row->where('singer_name', 'LIKE', '%' . $request->keyword . '%');
                }
            })
            ->paginate(10);
        $template = 'song.index';
        $config = [
            'seo' => config('apps.songs')
        ];
        return view('dashboard/layout', compact(
            'template',
            'config',
            'songs',
        ))->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function create()
    {
        $types = Song_type::all();
        $singers = Singer::all();
        $template = 'song.create';
        $config['seo'] = config('apps.songs');
        return view('dashboard/layout', compact(
            'template',
            'config',
            'types',
            'singers',
        ));
    }
    public function store(SongRequest $request)
    {

        $song = new Song();
        $song->song_name = $request->input('song_name');
        $song->nation = $request->input('nation');
        $song->type_id = $request->input('type_id');
        $song->singer_id = $request->input('singer_id');
        if ($request->hasFile('song_image')) {
            $file = $request->file('song_image');
            $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = $file->getClientOriginalExtension();

            if (in_array($extension, $allowedImageExtensions)) {
                $filename = StringHelper::convertToSlug($request->input('song_name')) . '.' . $extension;
                $file->move(public_path('images/song'), $filename);
                $song->song_image = $filename;
            } else {
                return back()->with('message', 'Hình ảnh không hợp lệ. Chỉ chấp nhận các định dạng: jpg, jpeg, png, gif.')->with('type', 'error');
            }
        }

        if ($request->hasFile('song_file')) {
            $file = $request->file('song_file');
            $allowedAudioExtensions = ['mp3', 'wav', 'flac'];
            $extension = $file->getClientOriginalExtension();

            if (in_array($extension, $allowedAudioExtensions)) {
                $filename = StringHelper::convertToSlug($request->input('song_name')) . '.' . $extension;
                $file->move(public_path('storage/song_file'), $filename);
                $song->song_file = $filename;
            } else {
                return back()->with('message', 'File âm thanh không hợp lệ. Chỉ chấp nhận các định dạng: mp3, wav, flac.')->with('type', 'error');
            }
        } else {
            return back()->with('message', 'Không tìm thấy file âm thanh.')->with('type', 'error');
        }

        $song->lyrics = $request->input('lyrics');

        $song->save();
        return redirect()->back()->with('message', 'Thêm bài hát thành công')->with('type', 'success');
    }

    public function edit($id)
    {
        $types = Song_type::all();
        $singers = Singer::all();
        $template = 'song.edit';
        $config['seo'] = config('apps.songs');
        $song =  Song::find($id);
        return view('dashboard/layout', compact(
            'song',
            'template',
            'config',
            'types',
            'singers',
        ));
    }

    public function update(Request $request, $id)
    {
        $song = Song::find($id);
        $song->song_name = $request->input('song_name');
        $song->nation = $request->input('nation');
        $song->type_id = $request->input('type_id');
        $song->singer_id = $request->input('singer_id');

        // Kiểm tra và xử lý file ảnh
        if ($request->hasFile('song_image')) {
            $oldfile = public_path('images/song/' . $song->song_image);
            if (File::exists($oldfile)) {
                File::delete($oldfile);
            }

            $file = $request->file('song_image');
            $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = $file->getClientOriginalExtension();

            if (in_array($extension, $allowedImageExtensions)) {
                $filename = StringHelper::convertToSlug($request->input('song_name')) . '.' . $extension;
                $file->move(public_path('images/song'), $filename);
                $song->song_image = $filename;
            } else {
                return back()->with('message', 'File hình ảnh không hợp lệ. Chỉ chấp nhận các định dạng: jpg, jpeg, png, gif.')->with('type', 'error');
            }
        }

        // Kiểm tra và xử lý file âm thanh
        if ($request->hasFile('song_file')) {
            $oldfile = public_path('storage/song_file/' . $song->song_file);
            if (File::exists($oldfile)) {
                File::delete($oldfile);
            }

            $file = $request->file('song_file');
            $allowedAudioExtensions = ['mp3', 'wav', 'flac'];
            $extension = $file->getClientOriginalExtension();

            if (in_array($extension, $allowedAudioExtensions)) {
                $filename = StringHelper::convertToSlug($request->input('song_name')) . '.' . $extension;
                $file->move(public_path('storage/song_file'), $filename);
                $song->song_file = $filename;
            } else {
                return back()->with('message', 'File âm thanh không hợp lệ. Chỉ chấp nhận các định dạng: mp3, wav, flac.')->with('type', 'error');
            }
        }

        $song->lyrics = $request->input('lyrics');
        $song->save();

        return redirect()->back()->with('message', 'Cập nhật bài hát thành công')->with('type', 'success');
    }

    public function delete($id)
    {
        $song = Song::findOrFail($id);
        $song->delete();

        return redirect()->route('song.index')->with('message', 'Xóa bài hát thành công')->with('type', 'success');
    }
}
