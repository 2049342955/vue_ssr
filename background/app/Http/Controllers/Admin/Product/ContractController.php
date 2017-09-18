<?php

/**
 * 合同模板管理
 * @author      mozarlee
 * @time        2017-07-12 09:31:47
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ContractTpl;
class ContractController extends Controller
{
	private $contract_tpl_object;

	function __construct()
	{
		$this->contract_tpl_object = new ContractTpl();
	}

    /**
     * 产品基类列表
     * @return [type] [description]
     */
    public function index(Request $request)
    {
        $data = $this->contract_tpl_object->getAll();

        $result = array(
            'data' => $data
        );
        return view('admin.product.showContractList', $result);
    }

    /**
     * 填写数据页面
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function showSave(Request $request)
    {
        $id = $request->input("id");
        $data = null;

        if (!empty($id)) {
            $data = $this->contract_tpl_object->getDataById($id);
        }

        $result = array(
            'data' => $data
            );
        return view('admin.product.showContract', $result);
    }

    /**
     * 保存数据
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function save(Request $request)
    {
        $params = $request->all();
        $params['modify_user'] = session('admin_info')['true_name'];
        $params['modify_time'] = time();
        
        $res = $this->contract_tpl_object->saveData($params);
        if ($res) {
            return redirect('product/contract');
        }
        return view('admin.error', ['body_style' => 'error-page', 'message' => '保存数据失败，请重试']);
    }

    /**
     * 预览协议内容
     * @return [type] [description]
     */
    public function preview(Request $request)
    {
        header("Content-Type:text/html;charset=utf-8");
        $id = $request->input('id');
        $data = $this->contract_tpl_object->getDataById($id);
        if (!empty($data)) {
            if (!empty($data['content'])) {
                echo $data['content'];
            } else if (!empty($data['transfer_content'])) {
                echo $data['transfer_content'];
            }
        }
        echo "null";
    }

}
