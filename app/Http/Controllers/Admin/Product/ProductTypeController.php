<?php

/**
 * 算力类型管理
 * @author      mozarlee
 * @time        2017-07-17 14:53:41
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ProductHashType;
class ProductTypeController extends Controller
{
    private $product_hash_type_object;

    function __construct()
    {
        $this->product_hash_type_object = new ProductHashType();
    }

    /**
     * 算力类型管理
     * @return [type] [description]
     */
    public function index(Request $request)
    {
        $data = $this->product_hash_type_object->getAll();

        $result = array(
            'data' => $data
            );
        return view('admin.product.showProductTypeList', $result);
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
            $data = $this->product_hash_type_object->getDataById($id);
        }

        $result = array(
            'data' => $data
            );
        return view('admin.product.showProductType', $result);
    }

    /**
     * 保存数据
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function save(Request $request)
    {
        $params = $request->all();

        $res = $this->product_hash_type_object->saveData($params);
        if ($res) {
            return redirect('product/hashtype');
        }
        return view('admin.error', ['body_style' => 'error-page', 'message' => '保存数据失败，请重试']);
    }

}
