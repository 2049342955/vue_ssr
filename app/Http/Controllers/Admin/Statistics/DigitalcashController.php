<?php

/**
 * 数据统计对账-用户数字货币统计
 * @author      mozarlee
 * @time        2017-07-13 11:36:44
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Statistics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UserCapital;
use App\Models\User;
use App\Models\UserHashIncomeDetails;
class DigitalcashController extends Controller
{
    private $user_object;

    function __construct()
    {
        $this->user_object = new User();
    }

    /**
     * 数据统计对账-用户数字货币统计
     * @return [type] [description]
     */
    public function index(Request $request)
    {
        // 获取所有用户
        $user_data = $this->user_object->getAll();

        // 统计用户数字货币流水
        $user_data = $this->stat($user_data);

        $result = array(
            'data' => $user_data
            );
        return view('admin.statistics.showDigitalcashList', $result);
    }

    /**
     * 根据姓名或手机号查询
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {
        $user_data = $this->user_object->search($request->input('search'));
        // 统计用户数字货币流水
        $user_data = $this->stat($user_data);

        $result = array(
            'data' => $user_data
            );
        return view('admin.statistics.showDigitalcashList', $result);
    }

    /**
     * 统计用户数字货币流水
     * @param  [type] $user_data [description]
     * @return [type]            [description]
     */
    private function stat($user_data)
    {
        // 统计用户数字货币流水
        $user_capital_object = new UserCapital();
        $user_hash_income_details_object = new UserHashIncomeDetails();

        foreach ($user_data as $key => $value) {
            // 获取总btc收益
            $user_data[$key]->btc_income_total = $user_hash_income_details_object->getUserBtcSum($value->id, 2);

            // 获取提币总额
            $user_data[$key]->btc_withdraw_total = $user_capital_object->getBtcSum($value->id, 16, 2);
            // 获取Btc卖出总额
            $btc_sold_total = abs($user_capital_object->getBtcSum($value->id, 15, 2));
            if ($btc_sold_total > 0) {
	            $user_data[$key]->btc_sold_total = '-' . $btc_sold_total;
            } else {
	            $user_data[$key]->btc_sold_total = $btc_sold_total;
            }

            $user_data[$key]->total_result = round(($user_data[$key]->btc_withdraw_total + $user_data[$key]->btc_sold_total + $user_data[$key]->btc_income_total), 2);
        }
        return $user_data;
    }

}
