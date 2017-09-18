<?php

/**
 * 数据统计对账-数字货币统计
 * @author      mozarlee
 * @time        2017-07-13 16:10:08
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Statistics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UserCapital;
use App\Models\UserHashIncomeDetails;
class DigitalstatController extends Controller
{
    private $user_capital_object;

    function __construct()
    {
        $this->user_capital_object = new UserCapital();
    }

    /**
     * 数据统计对账-数字货币统计
     * @return [type] [description]
     */
    public function index(Request $request)
    {
        $status = !empty($request->input('status')) ? $request->input('status') : 1;

        $today = strtotime(date('Y-m-d', time()));
        $tomorrow = $today + 86400;

        $data = null;
        $total_yen = null;

        if ($status == 1) {
            // 获取收益记录
            $user_hashincome_detail_object = new UserHashIncomeDetails();
            $data = $user_hashincome_detail_object->getDataByRange($today, $tomorrow, 2);
            $data = $this->dealData($data);
            $total_yen = $user_hashincome_detail_object->getTotalBtcByRange($today, $tomorrow, 2);

        } else {
            $data = $this->user_capital_object->getDataByRange($today, $tomorrow, $status, 2);
            $total_yen = $this->user_capital_object->getTotalBtcByRange($today, $tomorrow, $status, 2);
        }

        $result = array(
            'data' => $data,
            'total_yen' => $total_yen,
            'status' => $status
            );
        return view('admin.statistics.showDigitalstatList', $result);
    }

    /**
     * 查询
     * @param  Request $request [description]
     * @param  [type]  $status  [description]
     * @return [type]           [description]
     */
    public function search(Request $request, $status)
    {
        $today = strtotime($request->input('start'));
        $tomorrow = strtotime($request->input('end'));
        if ($tomorrow <= $today) {
            return view('admin.error', ['body_style' => 'error-page', 'message' => '截止时间必须大于起始时间']);
        }

        $data = null;
        $total_yen = null;

        if ($status == 1) {
            // 获取收益记录
            $user_hashincome_detail_object = new UserHashIncomeDetails();
            $data = $user_hashincome_detail_object->getDataByRange($today, $tomorrow, 2);
            $data = $this->dealData($data);
            $total_yen = $user_hashincome_detail_object->getTotalBtcByRange($today, $tomorrow, 2);
        } else {
            // 默认获取当天的充值记录
            $data = $this->user_capital_object->getDataByRange($today, $tomorrow, $status, 2);
            $total_yen = $this->user_capital_object->getTotalBtcByRange($today, $tomorrow, $status, 2);
        }

        $result = array(
            'data' => $data,
            'total_yen' => $total_yen,
            'status' => $status,
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            );
        return view('admin.statistics.showDigitalstatList', $result);
    }

    /**
     * 处理数据
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    private function dealData($data)
    {
        if (empty($data)) {
            return $data;
        }

        foreach ($data as $key => $value) {
            $data[$key]->btc_amount = $value->paid_amount;
            $data[$key]->description = '收益';
            $data[$key]->create_time = $value->payable_time;
        }
        return $data;
    }

}
