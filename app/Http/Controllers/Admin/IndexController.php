<?php
/**
 * 后台首页
 * 
 * @author                  mozarlee
 * @time                    2017-02-23 10:54:31
 * @created by              Sublime Text 3
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Modules;
class IndexController extends Controller
{
	/**
	 * 登录成功转发
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function index(Request $request){
        return redirect('home');
    }

    /**
     * 测试
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function test(Request $request){
        // $model = new Modules();
        // $res = $model->getAll();
        // var_dump($res);
    	exit("你要干啥？走错了吧");
    }
}
