<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use Session;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $admin_info = session('admin_info');
        if( empty($admin_info) ){
            // 登录
            return redirect('login');
        }

        // @TODO  检测用户是否有权限操作
        return $next($request);
    }
}
