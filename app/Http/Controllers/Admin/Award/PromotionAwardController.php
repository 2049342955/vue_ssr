<?php

/**
 * 推广奖励管理
 * @author      mozarlee
 * @time        2017-07-14 11:12:01
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Award;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UserCapital;
use App\Models\User;
class PromotionAwardController extends Controller
{
	private $user_capital_object;

	function __construct()
	{
		$this->user_capital_object = new UserCapital();
	}


    /**
     * 奖励列表
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        $data = $this->user_capital_object->getDataByType(20);

        // 获取奖励来源用户信息
        $user_objcet = new User();
        foreach ($data as $key => $value) {
            $source_user_id = str_replace('来源用户id:', '', $value['remark']);
            $user_msg = $user_objcet->getMsgById($source_user_id);
            if (!empty($user_msg)) {
                $data[$key]->source_user_mobile = $user_msg['mobile'];
            } else {
                $data[$key]->source_user_mobile = '';
            }
            unset($user_msg);
        }

        $result = array(
            'data' => $data
            );
        return view('admin.award.showPromotionAwardList', $result);
    }

}
