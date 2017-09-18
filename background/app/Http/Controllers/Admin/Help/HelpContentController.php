<?php

/**
 * 帮助中心内容管理
 * @author mozarlee <1393441583@qq.com>
 */
namespace App\Http\Controllers\Admin\Help;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Help;
use App\Models\HelpClass;
class HelpContentController extends Controller
{
	private $help_object;

	function __construct()
	{
		$this->help_object = new Help();
	}

    /**
     * 帮助中心内容管理首页
     * @return [type] [description]
     */
    public function index(Request $request)
    {
    	$result = $this->help_object->getAll();
    	$data = array(
    		'data' => $result
    		);
        return view('admin.help.help_content', $data);
    }

    /**
     * 新增
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function create(Request $request)
    {
    	$help_class_object = new HelpClass();
    	$cate = $help_class_object->getData();

    	$data = array(
    		'cate' => $cate
    		);
    	return view('admin.help.show_content', $data);
    }

    /**
     * 新增写入
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function doCreate(Request $request)
    {
    	$res = $this->help_object->saveData($request->all());
    	if( $res ){
    		return redirect('help_content');
    	}
        return view('admin.error', ['body_style' => 'error-page', 'message' => '新增内容失败，请重试']);
    }

    /**
     * 更新
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update(Request $request)
    {
    	$id = $request->input('id');
    	$result = $this->help_object->getDataById($id);

    	$help_class_object = new HelpClass();
    	$cate = $help_class_object->getData();

    	$data = array(
    		'data' => $result,
    		'cate' => $cate
    		);
    	return view('admin.help.show_content', $data);
    }

    /**
     * 更新写入
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function doUpdate(Request $request)
    {
    	$res = $this->help_object->saveData($request->all());
    	if( $res ){
    		return redirect('help_content');
    	}
    	return view('admin.error', ['body_style' => 'error-page', 'message' => '更新内容失败，请重试']);
    }

    /**
     * 删除
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function delete(Request $request)
    {
    	$id = $request->input('id');
    	$res = $this->help_object->deleteDataById($id);
    	if( $res ){
    		return redirect()->back();
    	}
    	return view('admin.error', ['body_style' => 'error-page', 'message' => '删除内容失败，请重试']);
    }

}
