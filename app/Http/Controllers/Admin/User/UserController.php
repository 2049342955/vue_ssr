<?php

/**
 * 用户管理
 * @author      mozarlee
 * @time        2017-07-11 13:59:32
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
class UserController extends Controller
{
	private $user_object;

	function __construct() 
	{
		$this->user_object = new User();
	}

    /**
     * 用户管理
     * @return [type] [description]
     */
    public function index(Request $request)
    {
    	$data = $this->user_object->getAll();

    	$result = array(
    		'data' => $data
    		);
    	return view('admin.user.showlist', $result);
    }

    /**
     * 根据姓名或手机号查询
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {
    	$data = $this->user_object->search($request->input('search'));

    	$result = array(
    		'data' => $data
    		);
    	return view('admin.user.showlist', $result);
    }

    /**
     * 禁止登陆、解禁
     * @return [type] [description]
     */
    public function forbidLogin(Request $request, $status) 
    {
    	$user_id = $request->input('user_id');
    	$res = $this->user_object->forbidLogin($user_id, $status);
    	if ($res) {
    		return redirect()->back();
    	}
        return view('admin.error', ['body_style' => 'error-page', 'message' => '更新状态失败，请重试']);
    }

    /**
     * 禁止提现、解禁
     * @param  Request $request [description]
     * @param  [type]  $status  [description]
     * @return [type]           [description]
     */
    public function forbidWithdraw(Request $request, $status) 
    {
    	$user_id = $request->input('user_id');
    	$res = $this->user_object->forbidWithdraw($user_id, $status);
    	if ($res) {
    		return redirect()->back();
    	}
        return view('admin.error', ['body_style' => 'error-page', 'message' => '更新状态失败，请重试']);
    }

    /**
     * 禁止交易、解禁
     * @param  Request $request [description]
     * @param  [type]  $status  [description]
     * @return [type]           [description]
     */
    public function forbidTrade(Request $request, $status) 
    {
    	$user_id = $request->input('user_id');
    	$res = $this->user_object->forbidTrade($user_id, $status);
    	if ($res) {
    		return redirect()->back();
    	}
        return view('admin.error', ['body_style' => 'error-page', 'message' => '更新状态失败，请重试']);
    }

}
