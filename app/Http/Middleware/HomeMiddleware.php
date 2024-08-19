<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use App\Models\User;
use App\Mail\VerifyAccount;
class HomeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
       
        if ($user && $user->status_disable == 0) {
            Auth::logout();
            return redirect()->route('auth.admin')->with('message', 'Tài khoản của bạn đã bị vô hiệu hóa')->with('type', 'error');
        }

        if ($user && $user->status_role == 1) {
            Auth::logout();
            return redirect()->route('auth.admin')->with('message', 'Tài khoản của bạn chưa được kích hoạt, kiểm tra email để kích hoạt tài khoản')->with('type', 'error');
        }
        return $next($request);
    }
}
