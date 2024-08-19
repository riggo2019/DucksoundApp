<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user && $user->status_role == 4) {
            return redirect()->route('user.index')->with('message', 'Bạn đã đăng nhập thành công với tư cách quản trị viên')->with('type', 'error');
        }
        if ($user && $user->status_role != 4) {
            return redirect()->route('home.index');
        }
        
        
        return $next($request);
    }
}
