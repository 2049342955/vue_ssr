<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Session;
use App\Models\Admin;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * 登录
     * @return [type] [description]
     */
    public function login(Request $request){
        $request->session()->forget('admin_info');

        $admin_model = new Admin();
        $res = $admin_model->loginCheck($request->all());
        if( empty($res) ){
            // 登录失败
            $request->session()->flash('login_error', '登录失败，用户名密码不匹配！');
            return redirect()->back();
        }


        $request->session()->put('admin_info', $res);
        // 登录成功
        return redirect($this->redirectTo);
    }
}
