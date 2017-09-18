<?php

/**
 * 产品管理
 * @author      mozarlee
 * @time        2017-07-12 11:46:43
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ProductHash;
use App\Models\ProductHashBase;
use App\Models\ContractTpl;
class ProductController extends Controller
{
	private $product_object;

	function __construct()
	{
		$this->product_object = new ProductHash();
	}

    /**
     * 产品列表
     * @return [type] [description]
     */
    public function index(Request $request)
    {
        $data = $this->product_object->getAll();

        $result = array(
            'data' => $data
        );
        return view('admin.product.showProductList', $result);
    }

    /**
     * 根据名称查询
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {
        $data = $this->product_object->search($request->input('search'));

        $result = array(
            'data' => $data,
            'search' => $request->input('search')
            );
        return view('admin.product.showProductList', $result);
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

        $product_base_object = new ProductHashBase();
        $product_base = $product_base_object->getAllArr();

        if (!empty($id)) {
            $data = $this->product_object->getDataById($id);
        }

        $result = array(
            'data' => $data,
            'product_base' => $product_base
            );
        return view('admin.product.showProduct', $result);
    }

    /**
     * 保存数据
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function save(Request $request)
    {
        $params = $request->all();
        
        // 相关时间处理
        $params['sell_start_time'] = dealDateLocalFormat4($params['sell_start_time']);
        $params['sell_end_time'] = dealDateLocalFormat4($params['sell_end_time']);
        $params['income_start_time'] = dealDateLocalFormat4($params['income_start_time']);
        $params['income_end_time'] = dealDateLocalFormat4($params['income_end_time']);

        // 获取协议合同以及算力类型
        $product_base_object = new ProductHashBase();
        $contract = $product_base_object->getDataById($params['product_base_id']);
        $params['contract_ids'] = $contract['contract_id'];
        $params['product_hash_type'] = $contract['product_hash_type'];

        $res = $this->product_object->saveData($params);
        if ($res) {
            return redirect('product/manage');
        }
        return view('admin.error', ['body_style' => 'error-page', 'message' => '保存数据失败，请重试']);
    }

    /**
     * 修改是否在首页展示
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function changeTop(Request $request, $status)
    {
        $res = $this->product_object->changeTop($request->input('id'), $status);
        if ($res) {
            return redirect()->back();
        }
        return view('admin.error', ['body_style' => 'error-page', 'message' => '修改失败，请重试']);
    }

    /**
     * 修改产品状态
     * @param  Request $request [description]
     * @param  [type]  $status  [description]
     * @return [type]           [description]
     */
    public function changeStatus(Request $request, $status)
    {
        $res = $this->product_object->changeStatus($request->input('id'), $status);
        if ($res) {
            return redirect()->back();
        }
        return view('admin.error', ['body_style' => 'error-page', 'message' => '修改失败，请重试']);
    }

}
