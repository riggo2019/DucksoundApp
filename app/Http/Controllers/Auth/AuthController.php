<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\VerifyAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if (Auth::attempt($credentials)) {
            Session::put('message', 'Đăng nhập thành công');
            Session::put('type', 'success');
            return redirect()->route('user.index');
        } else {
            // Session::put('message', 'Đăng nhập thành công');
            // Session::put('type', 'success');
            return redirect()->route('auth.admin')->with('error', 'Email hoặc mật khẩu không đúng.');
        }
    }
    public function login2use()
    {
        return view('auth.login2use')->with('error', 'Bạn cần đăng nhập để sử dụng tính năng này');
    }

    public function check_register(RegisterRequest $request)
    {
        $data = request()->all('fullname', 'email', 'phone');
        $data['password'] = Hash::make(request('password'));
        $data['active_token'] = mt_rand(10000000, 99999999);
        if ($user = User::create($data)) {
            Mail::to($user->email)->send(new VerifyAccount($user));
            return redirect()->route('auth.register')->with('success', 'Đăng ký tài khoản thành công, kiểm tra <a href="https://mail.google.com/" target="_blank">email</a> để tiến hành kích hoạt tài khoản');

        } else {
            return redirect()->route('auth.register')->with('error', 'Đăng ký tài khoản thất bại');
        }
    }

    public function verifyAccount($token)
    {
        $user = User::where('active_token', $token)->first();
        if ($user) {
            $user->active_token = null;
            $user->status_role = 2;
            $user->save();
            return redirect()->route('auth.admin')->with('success', 'Kích hoạt tài khoản thành công');
        }
        return redirect()->route('auth.admin')->with('error', 'Đường dẫn không hợp lệ hoặc đã hết hạn');
    }

    public function forgotPassword(ForgotRequest $request)
    {
        $email = request('email');
        if ($email) {
            $user = User::where('email', $email)->first();
            $user->forgot_token = mt_rand(10000000, 99999999);
            $user->update();
            if ($user) {
                Mail::to($user->email)->send(new ResetPassword($user));
                return redirect()->route('auth.forgot')->with('success', 'Gửi email thành công, vui lòng kiểm tra email để tiến hành đặt lại mật khẩu');
            } else {
                return redirect()->route('auth.forgot')->with('error', 'Gửi email thất bại');
            }
        } else {
            return redirect()->route('auth.forgot')->with('error', 'Vui lòng nhập email của bạn');
        }
    }

    public function resetPassword($token)
    {
        $user = User::where('forgot_token', $token)->first();

        if ($user) {
            $user->forgot_token = null;
            $user->save();
            return redirect()->route('auth.resetform', ['id' => $user->id]);
        }
        return redirect()->route('auth.forgot')->with('error', 'Đường dẫn không hợp lệ hoặc đã hết hạn');
    }

    public function resetForm($id)
    {
        $user = User::find($id);

        return view('auth.reset', compact('user'));
    }


    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);

        $user->password = Hash::make($request->input('password'));
        $user->update();
        return redirect()->route('auth.admin')->with('message', 'Cập nhật mật khẩu mới thành công')->with('type', 'success');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::put('message', 'Đăng xuất thành công');
        Session::put('type', 'success');
        return redirect()->route('home.index');
    }
}
