<?php

/**
 * 数字货币管理-兑换列表
 */
namespace App\Http\Controllers\Admin\Digitalcoin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UserCapital;
class DigitalTransferController extends Controller
{
    private $user_capital_object;

    function __construct()
    {
        $this->user_capital_object = new UserCapital();
    }
	   
    /**
     * 数字货币管理-兑换列表
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        $data = $this->user_capital_object->getDataByType(15);

        $result = array(
            'data' => $data
            );
        return view('admin.digitalcoin.showDigitalTransferList', $result);
    }

    /**
     * 查询
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {
        $data = $this->user_capital_object->search($request->input('search'), 15);

        $result = array(
            'data' => $data,
            'search' => $request->input('search')
            );
        return view('admin.digitalcoin.showDigitalTransferList', $result);
    }

}
