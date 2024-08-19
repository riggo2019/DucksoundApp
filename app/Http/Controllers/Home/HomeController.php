<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;
use App\Models\Favorite;
use App\Models\Playlist_info;
use App\Models\Playlist;
use App\Models\User;
use App\Models\Song_type;
use Illuminate\Support\Facades\DB;
use Jorenvh\Share\Share;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct() {}
    public function index(Request $request)
    {

        $isSearching = $request->keyword !== null && $request->keyword !== '';
        $template = 'home.index';
        $logged_in = false;
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();

        $song_list = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
            ->when($request->keyword !== null && $request->keyword !== '', function ($row) use ($request) {
                return $row->where('song_name', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('singer_name', 'LIKE', '%' . $request->keyword . '%');
            })
            ->get();
        $song_array = $song_list->toArray();
        $song_charts = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.views', 'desc')
            ->get();
        $types = DB::table('song_type')->limit(6)->get();

        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }
        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }

        $config = [
            'js' => [
                asset('/js/home/route/routeHome.js'),
            ],
            'active' => ''
        ];


        return view('home/layout', compact(
            'logged_in',
            'user',
            'ads',
            'song_list',
            'song_charts',
            'template',
            'playlist',
            'types',
            'favorite_list',
            'config',
            'isSearching',
        ))->with('i', 0);
    }

    public function type(Request $request)
    {
        $template = 'home.type';
        $logged_in = false;
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();

        if ($request->has('type') && !empty($request->type)) {
            $list_type = DB::table('songs')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->join('song_type', 'songs.type_id', '=', 'song_type.id')
                ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
                ->when($request->type !== null && $request->type !== '', function ($row) use ($request) {
                    return $row->where('type_id', $request->type);
                })
                ->get();
        } else {
            $list_type = null;
        }
        $song_charts = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.views', 'desc')
            ->get();
        $song_list = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
            ->get();
        $song_array = $song_list->toArray();
        $types = DB::table('song_type')->get();

        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }
        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }
        $config = [
            'js' => [
                asset('/js/home/route/routeType.js'),

            ],
            'active' => 'type'
        ];

        return view('home/layout', compact(
            'logged_in',
            'user',
            'ads',
            'song_list',
            'song_charts',
            'template',
            'playlist',
            'types',
            'favorite_list',
            'config',
            'list_type'
        ))->with('i', 0);
    }

    public function album(Request $request)
    {
        $template = 'home.album.album';
        $logged_in = false;
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();

        $song_list = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
            ->get();
        $song_array = $song_list->toArray();
        $song_charts = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.views', 'desc')
            ->get();

        $albums = DB::table('album')
            ->join('singer', 'album.singer_id', '=', 'singer.id')
            ->select('album.*', 'singer.singer_name')->orderBy('album.album_name', 'desc')
            ->get();

        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }
        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }

        $config = [
            'js' => [
                asset('/js/home/route/routeAlbum.js'),

            ],
            'active' => 'album'
        ];

        return view('home/layout', compact(
            'logged_in',
            'user',
            'ads',
            'song_list',
            'song_charts',
            'template',
            'playlist',
            'favorite_list',
            'config',
            'albums',
        ))->with('i', 0);
    }

    public function album_info(Request $request, $id)
    {
        $template = 'home.album.album_info';
        $logged_in = false;
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();

        $song_list = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
            ->get();
        $song_array = $song_list->toArray();
        $song_charts = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.views', 'desc')
            ->get();

        $album_list = DB::table('album_info')->where('album_info.album_id', $id)
            ->join('album', 'album_info.album_id', '=', 'album.id')
            ->join('songs', 'album_info.song_id', '=', 'songs.id')
            ->join('singer', 'album.singer_id', '=', 'singer.id')
            ->select('album_info.*', 'singer.singer_name', 'album.album_name', 'songs.*')
            ->get();
        $album = DB::table('album')->where('album.id', $id)
            ->select('album.album_name')
            ->first();
        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }
        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }

        $config = [
            'js' => [
                asset('/js/home/route/routeAlbum_info.js'),
            ],
            'active' => 'album'
        ];

        return view('home/layout', compact(
            'logged_in',
            'user',
            'ads',
            'song_list',
            'song_charts',
            'template',
            'playlist',
            'favorite_list',
            'config',
            'album_list',
            'album',
        ))->with('i', 0);
    }
    public function singer(Request $request)
    {
        $template = 'home.singer';
        $logged_in = false;
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();
        if ($request->has('singer') && !empty($request->singer)) {
            $list_singer = DB::table('songs')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->join('song_type', 'songs.type_id', '=', 'song_type.id')
                ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
                ->when($request->singer !== null && $request->singer !== '', function ($row) use ($request) {
                    return $row->where('singer_id', $request->singer);
                })
                ->get();
        } else {
            $list_singer = null;
        }
        $song_list = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
            ->get();
        $song_array = $song_list->toArray();

        $song_charts = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.views', 'desc')
            ->get();

        $singers = DB::table('singer')->get();


        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }
        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }

        $config = [
            'js' => [
                asset('/js/home/route/routeSinger.js'),
            ],
            'active' => 'singer'
        ];

        return view('home/layout', compact(
            'logged_in',
            'user',
            'ads',
            'list_singer',
            'song_list',
            'song_charts',
            'template',
            'playlist',
            'singers',
            'favorite_list',
            'config'
        ))->with('i', 0);
    }
    public function playlist(Request $request)
    {
        $template = 'home.playlist.playlist';
        $logged_in = false;
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();
        $song_list = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
            ->get();
        $song_array = $song_list->toArray();
        $song_charts = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.views', 'desc')
            ->get();
        if (isset($user)) {
            $playlist_list = DB::table('playlist')->where('users.id', $user->id)
                ->join('users', 'playlist.user_id', '=', 'users.id')
                ->select('playlist.*', 'users.fullname')
                ->get();
        } else {
            $playlist_list = collect()->first();
        }
        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }

        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }

        $config = [
            'js' => [
                asset('/js/home/route/routePlaylist.js'),

            ],
            'active' => 'playlist'
        ];
        if ($logged_in) {
            return view('home/layout', compact(
                'logged_in',
                'user',
                'ads',
                'song_list',
                'song_charts',
                'template',
                'playlist',
                'playlist_list',
                'favorite_list',
                'config'
            ))->with('i', 0);
        } else {
            return redirect()->route('auth.admin')
                ->with('message', 'Vui lòng đăng nhập để sử dụng chức năng này')
                ->with('type', 'error');
        }
    }

    public function playlist_info(Request $request, $id)
    {
        $template = 'home.playlist.playlist_info';
        $logged_in = false;
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();
        $song_list = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
            ->get();
        $song_array = $song_list->toArray();
        $song_charts = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.views', 'desc')
            ->get();
        if (isset($user)) {
            $playlist_list = DB::table('playlist_info')->where('playlist_info.playlist_id', $id)
                ->join('playlist', 'playlist_info.playlist_id', '=', 'playlist.id')
                ->join('songs', 'playlist_info.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('playlist_info.*', 'singer.singer_name', 'playlist.playlist_name', 'songs.*')
                ->get();

            $playlist_name = DB::table('playlist')->where('playlist.id', $id)
                ->select('playlist.*')
                ->first();
        } else {
            $playlist_list = collect();
            $playlist_name = collect()->first();
        }

        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }

        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }


        $config = [
            'js' => [
                asset('/js/home/route/routePlaylist_info.js'),
            ],
            'active' => 'playlist'
        ];
        if ($logged_in) {
            return view('home/layout', compact(
                'logged_in',
                'user',
                'ads',
                'song_list',
                'song_charts',
                'template',
                'playlist_list',
                'playlist',
                'playlist_name',
                'favorite_list',
                'config'
            ))->with('i', 0);
        } else {
            return redirect()->route('auth.admin')
                ->with('message', 'Vui lòng đăng nhập để sử dụng chức năng này')
                ->with('type', 'error');
        }
    }

    public function favorite(Request $request)
    {
        $template = 'home.favorite';
        $logged_in = false;
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();
        $song_list = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
            ->get();
        $song_array = $song_list->toArray();
        $song_charts = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.views', 'desc')
            ->get();
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }
        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }

        if ($user) {
            $logged_in = true;
        }

        $config = [
            'js' => [
                asset('/js/home/route/routeFavorite.js'),

            ],
            'active' => 'favorite'
        ];
        if ($logged_in) {
            return view('home/layout', compact(
                'logged_in',
                'user',
                'ads',
                'song_list',
                'song_charts',
                'template',
                'playlist',
                'favorite_list',
                'config'
            ))->with('i', 0);
        } else {
            return redirect()->route('auth.admin')
                ->with('message', 'Vui lòng đăng nhập để sử dụng chức năng này')
                ->with('type', 'error');
        }
    }

    public function addFavorite(Request $request)
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $songId = $request->input('song_id');

            $existingFavorite = DB::table('favorite')->where('user_id', $userId)
                ->where('song_id', $songId)
                ->first();

            if ($existingFavorite) {
                return back()->with('message', 'Bài hát đã có trong danh sách yêu thích')
                    ->with('type', 'error');
            }
            $favorite = new Favorite();
            $favorite->user_id = $userId;
            $favorite->song_id = $songId;
            $favorite->save();
            return back()->with('message', 'Thêm vào danh sách yêu thích thành công')
                ->with('type', 'success');
        } else {
            return redirect()->route('auth.admin')
                ->with('message', 'Vui lòng đăng nhập để sử dụng chức năng này')
                ->with('type', 'error');
        }
    }
    public function removeFavorite(Request $request)
    {
        $userId = Auth::user()->id;
        $songId = $request->input('song_id');

        // Xóa bài hát khỏi danh sách yêu thích
        DB::table('favorite')->where('user_id', $userId)
            ->where('song_id', $songId)
            ->delete();

        return redirect()->back()->with('message', 'Đã xóa bài hát khỏi danh sách yêu thích')
            ->with('type', 'success'); // Quay lại trang trước đó
    }
    public function addPlaylist(Request $request)
    {
        $userId = Auth::id(); // Lấy ID của người dùng đang đăng nhập
        $playlistCount = DB::table('playlist')
            ->where('user_id', $userId) // Lọc theo ID của người dùng
            ->count(); // Đếm số lượng playlist của người dùng đó

        if (Auth::user()) {
            if (Auth::user()->status_role == 2 && $playlistCount >= 5) {
                return redirect()->route('home.playlist')->with('message', 'Tài khoản của bạn không thể tạo thêm danh sách phát')->with('type', 'error');
            } else {

                $userId = Auth::user()->id;
                $playlistName = $request->input('playlist_name');
                $playlist = new Playlist();
                $playlist->user_id = $userId;
                $playlist->playlist_name = $playlistName;
                $playlist->save();
            }
            return redirect()->route('home.playlist')->with('message', 'Thêm playlist thành công')->with('type', 'success');
        } else {
            return redirect()->route('auth.admin')
                ->with('message', 'Vui lòng đăng nhập để sử dụng chức năng này')
                ->with('type', 'error');
        }
    }

    public function editPlaylist(Request $request, $id)
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $playlistName = $request->input('playlist_name');

            $playlist = Playlist::find($id);
            $playlist->user_id = $userId;
            $playlist->playlist_name = $playlistName;
            $playlist->update();

            return redirect()->route('home.playlist_info', ['id' => $playlist->id])->with('message', 'Đổi tên playlist thành công')->with('type', 'success');
        } else {
            return redirect()->route('auth.admin')
                ->with('message', 'Vui lòng đăng nhập để sử dụng chức năng này')
                ->with('type', 'error');
        }
    }

    public function removePlaylist($id)
    {
        if (Auth::user()) {
            $playlist = Playlist::findOrFail($id);
            $playlist->delete();

            return redirect()->route('home.playlist')->with('message', 'Xóa playlist thành công')->with('type', 'success');
        }
    }

    public function addPlaylistsong(Request $request)
    {
        if (Auth::user()) {
            $playlistId = $request->input('playlist_id');
            $songId = $request->input('song_id');


            $existingPlaylist = DB::table('playlist_info')->where('playlist_id', $playlistId)
                ->where('song_id', $songId)
                ->first();

            if ($existingPlaylist) {
                return back()->with('message', 'Bài hát đã có trong danh sách yêu thích')
                    ->with('type', 'error');
            }
            $playlist_info = new Playlist_info();
            $playlist_info->playlist_id = $playlistId;
            $playlist_info->song_id = $songId;
            $playlist_info->save();

            return back()->with('message', 'Thêm vào danh sách thành công')
                ->with('type', 'success');
        } else {
            return redirect()->route('auth.admin')
                ->with('message', 'Vui lòng đăng nhập để sử dụng chức năng này')
                ->with('type', 'error');
        }
    }

    public function removePlaylistsong(Request $request)
    {
        $playlistId = $request->input('playlist_id');
        $songId = $request->input('song_id');

        // Xóa bài hát khỏi danh sách yêu thích
        DB::table('playlist_info')->where('playlist_id', $playlistId)
            ->where('song_id', $songId)
            ->delete();

        return redirect()->back()->with('message', 'Đã xóa bài hát')
            ->with('type', 'success'); // Quay lại trang trước đó
    }

    public function news(Request $request)
    {
        $template = 'home.news.news';
        $logged_in = false;
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();
        $song_list = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
            ->get();
        $song_array = $song_list->toArray();
        $song_charts = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.views', 'desc')
            ->get();
        $news = DB::table('news')->orderBy('news.created_at', 'desc')->get();
        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }
        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }

        $config = [
            'js' => [
                asset('/js/home/route/routeNews.js'),

            ],
            'active' => 'news'
        ];

        return view('home/layout', compact(
            'logged_in',
            'user',
            'ads',
            'song_list',
            'song_charts',
            'template',
            'playlist',
            'favorite_list',
            'config',
            'news'
        ))->with('i', 0);
    }

    public function news_info(Request $request, $id)
    {
        $template = 'home.news.news_info';
        $logged_in = false;
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();
        $song_list = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
            ->get();
        $song_array = $song_list->toArray();
        $song_charts = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.views', 'desc')
            ->get();
        $news = DB::table('news')->where('news.id', $id)
            ->first();
        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }
        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }

        $config = [
            'js' => [
                asset('/js/home/route/routeNews_info.js'),
            ],
            'active' => 'news'
        ];

        return view('home/layout', compact(
            'logged_in',
            'user',
            'ads',
            'song_list',
            'song_charts',
            'template',
            'playlist',
            'favorite_list',
            'config',
            'news'
        ))->with('i', 0);
    }

    public function song($id)
    {
        $template = 'home.song';
        $songhead = 'home.component.songhead';
        $logged_in = false;
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();
        $song_list = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.song_name')
            ->get();
        $song_array = $song_list->toArray();
        $song_charts = DB::table('songs')
            ->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')->orderBy('songs.views', 'desc')
            ->get();

        $types = DB::table('song_type')->get();

        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }
        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }

        $config = [
            'js' => [
                asset('/js/home/route/routeSong.js'),
            ],
            'active' => ''
        ];

        $song = DB::table('songs')->where('songs.id', $id)->join('singer', 'songs.singer_id', '=', 'singer.id')
            ->join('song_type', 'songs.type_id', '=', 'song_type.id')
            ->select('songs.*', 'song_type.type_name', 'singer.singer_name')
            ->first();
        $shareButtons = (new Share)->page(
            url('/songs' . '/' . $id),
            $song->song_name . ' - ' . $song->singer_name,
        )->facebook();

        return view('home/layout', compact(
            'logged_in',
            'user',
            'ads',
            'songhead',
            'song_list',
            'song_charts',
            'template',
            'playlist',
            'types',
            'shareButtons',
            'song',
            'favorite_list',
            'config'
        ))->with(['i' => 0]);
    }

    public function profile(Request $request)
    {
        $template = 'home.user.profile';
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();
        $noPlayer = true;
        $logged_in = false;
        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }
        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }
        $config = [
            'js' => [],
            'active' => ''
        ];

        return view('home/layout', compact(
            'template',
            'playlist',
            'logged_in',
            'user',
            'ads',
            'noPlayer',
            'config',
            'favorite_list',
        ));
    }

    public function changepass(Request $request)
    {
        $template = 'home.user.changepass';
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();
        $noPlayer = true;
        $logged_in = false;
        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }
        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }
        $config = [
            'js' => [],
            'active' => ''
        ];

        return view('home/layout', compact(
            'template',
            'playlist',
            'logged_in',
            'user',
            'ads',
            'noPlayer',
            'config',
            'favorite_list',
        ));
    }

    public function upgrade(Request $request)
    {
        $template = 'home.user.upgrade';
        $user = Auth::user();
        $ads = DB::table('ads')->inRandomOrder()->limit(1)->first();
        $noPlayer = true;
        $logged_in = false;
        if ($user) {
            $logged_in = true;
        }
        if (isset($user)) {
            $favorite_list = DB::table('favorite')->where('favorite.user_id', $user->id)
                ->join('songs', 'favorite.song_id', '=', 'songs.id')
                ->join('singer', 'songs.singer_id', '=', 'singer.id')
                ->select('favorite.*', 'singer.singer_name', 'songs.*')
                ->get();
        } else {
            $favorite_list = collect();
        }
        if (isset($user)) {
            $playlist = DB::table('playlist')->where('playlist.user_id', $user->id)
                ->get();
        } else {
            $playlist = collect();
        }

        $config = [
            'js' => [],
            'active' => ''
        ];

        return view('home/layout', compact(
            'template',
            'playlist',
            'logged_in',
            'user',
            'ads',
            'noPlayer',
            'config',
            'favorite_list',
        ));
    }

    public function upgradeAccount(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($request->vnp_Amount == 2000000) {
            $user->status_role = 3;
            $user->upgrade_expires_at = Carbon::now()->addMonth();
        }
        if ($request->vnp_Amount == 20000000) {
            $user->status_role = 3;
            $user->upgrade_expires_at = Carbon::now()->addYear();
        }
        $user->save();
        return redirect()->route('home.index')->with('message', 'Nâng cấp tài khoản thành công thành công!')->with('type', 'success');
    }


    public function banquyen(Request $request)
    {
        return view('home/banquyen');
    }

    public function increViews(Request $request)
    {
        $id = $request->input('songId2');
        if ($id != null) {
            $song = Song::find($id);
            $song->views += 1;
            $song->save();
        }
        return response()->noContent();
    }

    public function download(Request $request)
    {
        $id = $request->input('songId1');
        $filename = Song::find($id)->song_file;
        $file = public_path('storage/song_file/' . $filename);
        if (file_exists($file)) {
            return response()->download($file, $filename, [
                'Content-Type' => 'audio/mpeg',
            ]);
        } else {
            return abort(404, 'File không tồn tại');
        }
    }
}
