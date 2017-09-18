<?php

/**
 * 产品基类设置
 * @author      mozarlee
 * @time        2017-07-11 16:26:30
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ProductHashBase;
use App\Models\ProductHashType;
use App\Models\ContractTpl;
class ProductBaseController extends Controller
{
	private $product_base_object;

	function __construct()
	{
		$this->product_base_object = new ProductHashBase();
	}

    /**
     * 产品基类列表
     * @return [type] [description]
     */
    public function index(Request $request)
    {
        $data = $this->product_base_object->getAll();

        $result = array(
            'data' => $data            );
        return view('admin.product.showProductBaseList', $result);
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

        $contracttpl_object = new ContractTpl();
        $contract = $contracttpl_object->getAllArr();

        $product_hash_type_object = new ProductHashType();
        $product_type = $product_hash_type_object->getAllArr();

        if (!empty($id)) {
            $data = $this->product_base_object->getDataById($id);
        }

        $result = array(
            'data' => $data,
            'contract' => $contract,
            'product_type' => $product_type
            );
        return view('admin.product.showProductBase', $result);
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

        $res = $this->product_base_object->saveData($params);
        if ($res) {
            return redirect('product/base');
        }
        return view('admin.error', ['body_style' => 'error-page', 'message' => '保存数据失败，请重试']);
    }

}
