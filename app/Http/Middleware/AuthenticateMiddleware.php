<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if($user == null){
            return redirect()->route('auth.admin')->with('message', 'Vui lòng đăng nhập với tài khoản admin')->with('type', 'error');
        }elseif($user->status_role != 4){
            return redirect()->route('auth.admin')->with('message', 'Bạn không phải admin')->with('type', 'error');
        }
        

        return $next($request);
    }
}
