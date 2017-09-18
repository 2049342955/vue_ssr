<?php

/**
 * 充值管理
 * @author      mozarlee
 * @time        2017-07-12 19:21:16
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Yen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AccountCapitalRachargeLog;
class RechargeController extends Controller
{
    private $reacharge_log_object;

    function __construct()
    {
        $this->reacharge_log_object = new AccountCapitalRachargeLog();
    }

    /**
     * 充值列表
     * @return [type] [description]
     */
    public function index(Request $request)
    {
    	$data = $this->reacharge_log_object->getAll();

    	$result = array(
    		'data' => $data
    		);
    	return view('admin.yen.showRechargeList', $result);
    }

    /**
     * 根据手机号码查询
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {
        $data = $this->reacharge_log_object->search($request->input('search'));
        $result = array(
            'data' => $data,
            'search' => $request->input('search')
            );
        return view('admin.yen.showRechargeList', $result);
    }

}
