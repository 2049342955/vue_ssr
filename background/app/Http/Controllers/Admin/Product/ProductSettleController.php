<?php

/**
 * 产品结算
 * @author      mozarlee
 * @time        2017-07-12 15:20:02
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UserHashIncome;
use App\Models\UserHashIncomeDetails;
use App\Models\OrderHash;
class ProductSettleController extends Controller
{
	private $hash_income_object;

	function __construct()
	{
		$this->hash_income_object = new UserHashIncome();
	}

    /**
     * 结算列表
     * @return [type] [description]
     */
    public function index(Request $request)
    {
        $data = $this->hash_income_object->getAll();

        $result = array(
            'data' => $data
        );
        return view('admin.product.showProductSettleList', $result);
    }

    /**
     * 录入收益
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function showInsertIncome(Request $request, $id)
    {
        $data = $this->hash_income_object->getDataById($id);
        $result = array(
            'data' => $data
        );
        return view('admin.product.showInsertIncome', $result);
    }

    /**
     * 保存收益
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function insertIncome(Request $request, $id)
    {
        $params = $request->all();
        $params['mine_user'] = session('admin_info')['true_name'];
        $params['mine_time'] = time();

        $res = $this->hash_income_object->saveIncome($params);
        if ($res) {
            return redirect('product/settle');
        }
        return view('admin.error', ['body_style' => 'error-page', 'message' => '保存数据失败，请重试']);
    }

    /**
     * 允许分配
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function allowDistribution(Request $request, $id)
    {
        $res = $this->hash_income_object->changeStatus($id, 2);
        if ($res) {
            return redirect('product/settle');
        }
        return view('admin.error', ['body_style' => 'error-page', 'message' => '保存数据失败，请重试']);
    }

    /**
     * 执行分配操作
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function distribution(Request $request, $id)
    {
        $data = $this->hash_income_object->getDataById($id);
        if (empty($data)) {
            return view('admin.error', ['body_style' => 'error-page', 'message' => '数据不存在。']);
        }

        if ($data['hash_total'] <= 0) {
            return view('admin.error', ['body_style' => 'error-page', 'message' => '总产品数量为0，不可分配。']);
        }

        // 事务处理
        // 分配到每个用户的记录user_hash_income_details
        // 修改user_hash_income状态为已分配
        $hash_income_detail_object = new UserHashIncomeDetails();
        $res = $hash_income_detail_object->updateIncome($id, $data['mine_amount'], $data['hash_total']);

        if (!$res) {
            return view('admin.error', ['body_style' => 'error-page', 'message' => '分配出现错误。']);
        }
        return redirect()->back();
    }

    /**
     * 分配审核通过
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function checkAccess(Request $request, $id)
    {
        // 事务处理
        // user_hash_income审核状态，审核用户，审核时间
        // user_hash_income_details审核状态修改
        $params['audit_user'] = session('admin_info')['true_name'];
        $params['audit_time'] = time();
        $params['id'] = $id;

        $res = $this->hash_income_object->checkAccess($params);
        if (!$res) {
            return view('admin.error', ['body_style' => 'error-page', 'message' => '审核失败，请重试。']);
        }
        return redirect()->back();
    }

    /**
     * 转账
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function transfer(Request $request, $id)
    {
        // 事务处理
        // 修改user表中用户余额btc_account
        //修改order_hash表的realized_income_value
        // 修改user_hash_income表中distribution_user, distribution_time, status
        // 修改user_hash_income_details表中paid_time, paid_amount, status->2
        $params['distribution_user'] = session('admin_info')['true_name'];
        $params['distribution_time'] = time();
        $params['id'] = $id;

        $res = $this->hash_income_object->transfer($params);
        if (!$res) {
            return view('admin.error', ['body_style' => 'error-page', 'message' => '转账失败，请重试。']);
        }
        return redirect()->back();
    }

}
