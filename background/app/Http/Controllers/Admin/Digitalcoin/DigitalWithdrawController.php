<?php

/**
 * 数字货币管理-提币管理
 */
namespace App\Http\Controllers\Admin\Digitalcoin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AccountBtcWithdrawLog;
class DigitalWithdrawController extends Controller
{
	private $account_btc_withdraw_object;

	function __construct()
	{
		$this->account_btc_withdraw_object = new AccountBtcWithdrawLog();
	}
	   
    /**
     * 数字货币管理-提币列表
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        $data = $this->account_btc_withdraw_object->getAll();

        $result = array(
        	'data' => $data
        	);
        return view('admin.digitalcoin.showDigitalWithdrawList', $result);
    }

    /**
     * 根据手机号查询
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {
    	$data = $this->account_btc_withdraw_object->search($request->input('search'));

        $result = array(
        	'data' => $data,
        	'search' => $request->input('search')
        	);
        return view('admin.digitalcoin.showDigitalWithdrawList', $result); 
    }

    /**
     * 审核通过进行下一步
     * account_btc_withdraw_log修改状态为处理中
     * user_capital修改状态为处理中
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function checkAccess(Request $request)
    {
    	$params = $request->all();
    	$res = $this->account_btc_withdraw_object->checkAccess($params);
    	if ($res) {
            return redirect()->back();
        }

        return view('admin.error', ['body_style' => 'error-page', 'message' => '更新失败，请重试']);
    }

    /**
     * 打币完成
     * 冻结btc变动
     * account_btc_withdraw_log修改状态
     * user_capital修改状态
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function transferBtcDone(Request $request)
    {
    	$params = $request->all();
    	$params['pay_username'] = session('admin_info')['true_name'];
        $params['pay_time'] = time();

    	$res = $this->account_btc_withdraw_object->transferBtcDone($params);
    	if ($res) {
            return redirect()->back();
        }

        return view('admin.error', ['body_style' => 'error-page', 'message' => '更新失败，请重试']);
    }


    /**
     * 取消提币
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function cancel(Request $request)
    {
    	$params = $request->all();
    	$params['pay_username'] = session('admin_info')['true_name'];
        $params['pay_time'] = time();

        $res = $this->account_btc_withdraw_object->cancel($params);
    	if ($res) {
            return redirect()->back();
        }

        return view('admin.error', ['body_style' => 'error-page', 'message' => '更新失败，请重试']);
    }

}
