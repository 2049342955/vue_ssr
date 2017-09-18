<?php

/**
 * 转让产品管理
 */
namespace App\Http\Controllers\Admin\Attorn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\TransferOrder;
class AttornController extends Controller
{
    private $transfer_order_object;

    function __construct()
    {
        $this->transfer_order_object = new TransferOrder();
    }
    
    /**
     * 转让产品列表
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        $data = $this->transfer_order_object->getAll();

        $result = array(
            'data' => $data
            );
        return view('admin.attorn.showList', $result);
    }
}
