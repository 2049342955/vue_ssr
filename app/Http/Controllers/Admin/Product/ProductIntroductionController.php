<?php

/**
 * 产品基类产品介绍
 * @author      mozarlee
 * @time        2017-07-11 17:23:24
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ProductHashIntroduction;
use App\Models\ProductHashBase;
class ProductIntroductionController extends Controller
{
	private $product_introduction_object;

	function __construct()
	{
		$this->product_introduction_object = new ProductHashIntroduction();
	}

    /**
     * 产品基类产品介绍
     * @return [type] [description]
     */
    public function index(Request $request, $base_id)
    {
        $data = $this->product_introduction_object->getBaseRecord($base_id);

        $product_base_obj = new ProductHashBase();
        $base_data = $product_base_obj->getDataById($base_id);

        $result = array(
            'data' => $data,
            'base_data' => $base_data,
            'base_id' => $base_id
        );
        return view('admin.product.showProductIntroductionList', $result);
    }

    /**
     * 填写数据页面
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function showSave(Request $request, $base_id)
    {
        $id = $request->input("id");
        $data = null;

        $product_base_obj = new ProductHashBase();
        $base_data = $product_base_obj->getDataById($base_id);

        if (!empty($id)) {
            $data = $this->product_introduction_object->getDataById($id);
        }

        $result = array(
            'data' => $data,
            'base_data' => $base_data,
            'base_id' => $base_id
            );
        return view('admin.product.showProductIntroduction', $result);
    }

    /**
     * 保存数据
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function save(Request $request, $base_id)
    {
        $params = $request->all();
        $params['modify_user'] = session('admin_info')['true_name'];
        $params['modify_time'] = time();
        $params['product_base_id'] = $base_id;

        $res = $this->product_introduction_object->saveData($params);
        if ($res) {
            return redirect('product/base/introduction/'.$base_id);
        }
        return view('admin.error', ['body_style' => 'error-page', 'message' => '保存数据失败，请重试']);
    }

    /**
     * 删除
     * @param  Request $request [description]
     * @param  [type]  $base_id [description]
     * @return [type]           [description]
     */
    public function delete(Request $request, $base_id)
    {
        $res = $this->product_introduction_object->deleteDataById($request->input('id'));
        if ($res) {
            return redirect('product/base/introduction/'.$base_id);
        }
        return view('admin.error', ['body_style' => 'error-page', 'message' => '删除数据失败，请重试']);
    }

}
