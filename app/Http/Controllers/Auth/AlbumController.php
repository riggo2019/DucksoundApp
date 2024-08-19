<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Album;
use App\Models\Singer;
use App\Models\Song_type;
use App\Models\Album_info;
use Illuminate\Support\Facades\DB;
use App\Helpers\StringHelper;


class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $albums = DB::table('album')
            ->join('singer', 'album.singer_id', '=', 'singer.id')
            ->select('album.*', 'singer.singer_name')
            ->paginate(10);

        $template = 'album.index';
        $config = [
            'seo' => config('apps.album')
        ];
        $singers = Singer::all();
        return view('dashboard/layout', compact(
            'template',
            'config',
            'albums',
            'singers',
        ))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function list(Request $request, $id)
    {
        $album_infos = DB::table('album_info')->where('album_id', $id)
            ->join('songs', 'album_info.song_id', '=', 'songs.id')
            ->select('album_info.*', 'songs.song_name', 'songs.views', 'songs.song_image')
            ->orderBy('album_info.id')
            ->when($request->keyword !== null, function ($row) use ($request) {
                return $row->where('song_name', 'LIKE', '%' . $request->keyword . '%');
            })
            ->paginate(5);
        $album = Album::find($id);
        $template = 'album_info.index';
        $config = [
            'seo' => config('apps.album')
        ];
        return view('dashboard/layout', compact(
            'template',
            'config',
            'album_infos',
            'album',
            'id'
        ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $album = new Album();
        $album->album_name = $request->album_name;
        $album->singer_id = $request->singer_id;
        if ($request->hasFile('album_image')) {
            if ($file = $request->file('album_image')) {
                $extension = $file->getClientOriginalExtension();
                $filename = StringHelper::convertToSlug($request->input('album_name')) . '.' . $extension;
                $file->move(public_path('images/album'), $filename);
                $album->album_image = $filename;
            } else {
                return back()->with('message', 'Hình ảnh không hợp lệ.')->with('type', 'error');
            }
        }
        $album->save();
        return redirect()->route('album.index')->with('message', 'Thêm album thành công.')->with('type', 'success');
    }
    public function getAlbum(Request $request)
    {
        $albumId = $request->query('id');
        $album = Album::find($albumId);
        return response()->json($album);
    }

    public function delete($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();
        return redirect()->route('album.index')->with('message', 'Xóa album thành công')->with('type', 'success');
    }

    public function remove($id)
    {
        $album_info = Album_info::findOrFail($id);
        $album_info->delete();
        return redirect()->back()->with('message', 'Xóa bài hát ra khỏi album thành công')->with('type', 'success');
    }

    public function addSong(Request $request, $id)
    {
        $songs = DB::table('songs')
            ->where('songs.singer_id', $id)
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->leftJoin('album_info', 'songs.id', '=', 'album_info.song_id')
            ->whereNull('album_info.song_id')
            ->select('songs.*', 'singer.singer_name')
            ->paginate(5);
        $album = DB::table('album')->where('album.singer_id', $id)->first();
        $types = Song_type::all();
        $singer = DB::table('singer')
            ->where('singer.id', $id)->first();
        $template = 'album_info.create';
        $config = [
            'seo' => config('apps.album')
        ];
        return view('dashboard/layout', compact(
            'template',
            'config',
            'songs',
            'types',
            'singer',
            'album'
        ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function addAlbumlist(Request $request, $song_id, $album_id)
    {
        $album_info = new Album_info();
        $album_info->song_id = $song_id;
        $album_info->album_id = $album_id;

        $album_info->save();
        return redirect()->back()->with('message', 'Thêm bài hát vào album thành công.')->with('type', 'success');
    }
}
