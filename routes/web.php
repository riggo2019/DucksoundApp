<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\SongController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\TypeController;
use App\Http\Controllers\Auth\SingerController;
use App\Http\Controllers\Auth\NewsController;
use App\Http\Controllers\Auth\AlbumController;
use App\Http\Controllers\Home\PaymentController;
use App\Http\Controllers\Auth\AdsController;

use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\HomeMiddleware;
use App\Http\Middleware\LoginMiddleware;
use App\Mail\VerifyAccount;
use Illuminate\Support\Facades\Mail;


Route::get('/api/getAlbum', [AlbumController::class, 'getAlbum']);
Route::get('/', function () {
    return view('welcome');
})->name('/')->middleware(LoginMiddleware::class);;

Route::get('/load', function () {
    return view('etc.loading');
});

Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])
    ->name('home.payment');

Route::get('/verify/{active_token}', [AuthController::class, 'verifyAccount'])
    ->name('auth.verify')->middleware(LoginMiddleware::class);

Route::get('/upgradeAccount', [HomeController::class, 'upgradeAccount'])
    ->name('home.upgradeAccount');

Route::get('/reset/{forgot_token}', [AuthController::class, 'resetPassword'])
    ->name('auth.reset')->middleware(LoginMiddleware::class);

Route::get('/resetform/{id}', [AuthController::class, 'resetForm'])->name('auth.resetform')->middleware(LoginMiddleware::class);

Route::post('updatePassword/{id}', [AuthController::class, 'updatePassword'])
    ->name('auth.updatePassword');


//Group chung
Route::group(['prefix' => 'auth'], function () {
    Route::get('/admin', [AuthController::class, 'index'])
        ->name('auth.admin')->middleware(LoginMiddleware::class);

    Route::get('/register', function () {
        return view('auth.register');
    })->name('auth.register')->middleware(LoginMiddleware::class);
    Route::get('/forgot', function () {
        return view('auth.forgot');
    })->name('auth.forgot')->middleware(LoginMiddleware::class);;

    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/register', [AuthController::class, 'check_register']);
    Route::post('/forgot', [AuthController::class, 'forgotPassword']);
});

//Group quản lí homepage
Route::group(['prefix' => ''], function () {
    Route::get('index', [HomeController::class, 'index'])
        ->name('home.index')->middleware(HomeMiddleware::class);
    Route::get('type', [HomeController::class, 'type'])
        ->name('home.type');
    Route::get('album', [HomeController::class, 'album'])
        ->name('home.album');
    Route::get('album_info/{id}', [HomeController::class, 'album_info'])
        ->name('home.album_info');
    Route::get('singer', [HomeController::class, 'singer'])
        ->name('home.singer');
    Route::get('playlist', [HomeController::class, 'playlist'])
        ->name('home.playlist');
    Route::get('playlist_info/{id}', [HomeController::class, 'playlist_info'])
        ->name('home.playlist_info');
    Route::get('favorite', [HomeController::class, 'favorite'])
        ->name('home.favorite');
    Route::get('songs/{id}', [HomeController::class, 'song'])
        ->name('home.song');
    Route::get('news', [HomeController::class, 'news'])
        ->name('home.news');
    Route::get('news_info/{id}', [HomeController::class, 'news_info'])
        ->name('home.news_info');
    Route::get('banquyen', [HomeController::class, 'banquyen'])
        ->name('home.banquyen');

    Route::get('profile', [HomeController::class, 'profile'])
        ->name('home.profile');
    Route::get('changepass', [HomeController::class, 'changepass'])
        ->name('home.changepass');
    Route::get('upgrade', [HomeController::class, 'upgrade'])
        ->name('home.upgrade');

    Route::post('addFavorite', [HomeController::class, 'addFavorite'])
        ->name('home.addFavorite');
    Route::post('removeFavorite', [HomeController::class, 'removeFavorite'])
        ->name('home.removeFavorite');

    Route::post('addPlaylistsong', [HomeController::class, 'addPlaylistsong'])
        ->name('home.addPlaylistsong');
    Route::post('removePlaylistsong', [HomeController::class, 'removePlaylistsong'])
        ->name('home.removePlaylistsong');
    Route::post('addPlaylist', [HomeController::class, 'addPlaylist'])
        ->name('home.addPlaylist');

    Route::post('editPlaylist/{id}', [HomeController::class, 'editPlaylist'])
        ->name('home.editPlaylist');

    Route::get('removePlaylist/{id}', [HomeController::class, 'removePlaylist'])
        ->name('home.removePlaylist');

    Route::post('/increViews', [HomeController::class, 'increViews'])->name('home.increViews');
    Route::post('/download', [HomeController::class, 'download'])->name('home.download');
});

//Group quản lí dashboard
Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/index', [DashboardController::class, 'index'])
        ->name('dashboard.layout')->middleware(AuthenticateMiddleware::class);
});

//Group quản lí users
Route::group(['prefix' => 'user'], function () {
    Route::get('index', [UserController::class, 'index'])
        ->name('user.index')->middleware(AuthenticateMiddleware::class);
    Route::get('create', [UserController::class, 'create'])
        ->name('user.create')->middleware(AuthenticateMiddleware::class);
    Route::get('edit/{id}', [UserController::class, 'edit'])
        ->name('user.edit')->middleware(AuthenticateMiddleware::class);
    Route::get('editpass/{id}', [UserController::class, 'editpass'])
        ->name('user.editpass')->middleware(AuthenticateMiddleware::class);

    Route::post('store', [UserController::class, 'store'])
        ->name('user.store');
    Route::post('update/{id}', [UserController::class, 'update'])
        ->name('user.update');
    Route::post('updatePass/{id}', [UserController::class, 'updatePass'])
        ->name('user.updatePass');

    Route::get('/user/update-status/{id}', [UserController::class, 'updateStatus'])->name('user.updateSd');
});

//Group quản lí bài hát
Route::group(['prefix' => 'song'], function () {
    Route::get('index', [SongController::class, 'index'])
        ->name('song.index')->middleware(AuthenticateMiddleware::class);
    Route::get('create', [SongController::class, 'create'])
        ->name('song.create')->middleware(AuthenticateMiddleware::class);
    Route::get('edit/{id}', [SongController::class, 'edit'])
        ->name('song.edit')->middleware(AuthenticateMiddleware::class);

    Route::post('store', [SongController::class, 'store'])
        ->name('song.store');
    Route::post('update/{id}', [SongController::class, 'update'])
        ->name('song.update');
    Route::delete('/delete/{id}', [SongController::class, 'delete'])->name('song.delete');
});

//Group quản lí loại bh
Route::group(['prefix' => 'type'], function () {
    Route::get('index', [TypeController::class, 'index'])
        ->name('type.index')->middleware(AuthenticateMiddleware::class);
    Route::post('/store', [TypeController::class, 'store'])
        ->name('type.store');

    Route::post('/update/{id}', [TypeController::class, 'update'])
        ->name('type.update');
    Route::delete('/delete/{id}', [TypeController::class, 'delete'])->name('type.delete');
});
//Group quản lí ca sĩ
Route::group(['prefix' => 'singer'], function () {
    Route::get('index', [SingerController::class, 'index'])
        ->name('singer.index')->middleware(AuthenticateMiddleware::class);

    Route::post('store', [SingerController::class, 'store'])
        ->name('singer.store');
    Route::post('update/{id}', [SingerController::class, 'update'])
        ->name('singer.update');
    Route::delete('/delete/{id}', [SingerController::class, 'delete'])->name('singer.delete');
});
// chưa fix được lỗi thêm type, singer

//Group quản lí tin tức
Route::group(['prefix' => 'news'], function () {
    Route::get('index', [NewsController::class, 'index'])
        ->name('news.index')->middleware(AuthenticateMiddleware::class);
    Route::get('create', [NewsController::class, 'create'])
        ->name('news.create')->middleware(AuthenticateMiddleware::class);
    Route::get('edit/{id}', [NewsController::class, 'edit'])
        ->name('news.edit')->middleware(AuthenticateMiddleware::class);

    Route::post('store', [NewsController::class, 'store'])
        ->name('news.store');
    Route::post('update/{id}', [NewsController::class, 'update'])
        ->name('news.update');
    Route::delete('/delete/{id}', [NewsController::class, 'delete'])->name('news.delete');
});

//Group quản lí album
Route::group(['prefix' => 'album'], function () {
    Route::get('index', [AlbumController::class, 'index'])
        ->name('album.index')->middleware(AuthenticateMiddleware::class);
    Route::get('list/{id}', [AlbumController::class, 'list'])
        ->name('album.list')->middleware(AuthenticateMiddleware::class);
    Route::get('addSong/{id}', [AlbumController::class, 'addSong'])
        ->name('album.addSong');
    Route::get('addAlbumlist/{song_id}/{album_id}', [AlbumController::class, 'addAlbumlist'])
        ->name('album.addAlbumlist');

    Route::post('store', [AlbumController::class, 'store'])
        ->name('album.store');
    Route::post('update/{id}', [AlbumController::class, 'update'])
        ->name('album.update');
    Route::delete('/delete/{id}', [AlbumController::class, 'delete'])->name('album.delete');
    Route::delete('/remove/{id}', [AlbumController::class, 'remove'])->name('album.remove');

});


//Group quản lí quảng cáo
Route::group(['prefix' => 'ads'], function () {
    Route::get('index', [AdsController::class, 'index'])
        ->name('ads.index')->middleware(AuthenticateMiddleware::class);
    Route::get('create', [AdsController::class, 'create'])
        ->name('ads.create')->middleware(AuthenticateMiddleware::class);
    Route::get('edit/{id}', [AdsController::class, 'edit'])
        ->name('ads.edit')->middleware(AuthenticateMiddleware::class);

    Route::post('store', [AdsController::class, 'store'])
        ->name('ads.store');
    Route::post('update/{id}', [AdsController::class, 'update'])
        ->name('ads.update');
    Route::delete('/delete/{id}', [AdsController::class, 'delete'])->name('ads.delete');
});