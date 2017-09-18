<?php

/**
 * 帮助中心模块管理
 * 
 * @author              mozarlee
 * @time                2017-02-23 11:19:20
 * @created by          Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Help;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\HelpClass;
class HelpClassController extends Controller
{
	private $help_class_object;

	function __construct()
	{
		$this->help_class_object = new HelpClass();
	}

    /**
     * 帮助中心模块管理首页
     * @return [type] [description]
     */
    public function index(Request $request)
    {
    	$result = $this->help_class_object->getAll();

    	$data = array(
    		'data' => $result
    		);
        return view('admin.help.help_module', $data);
    }

    /**
     * 新增
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function create(Request $request)
    {
    	return view('admin.help.show_module');
    }

    /**
     * 新增写入
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function doCreate(Request $request)
    {
    	$res = $this->help_class_object->saveData($request->all());
    	if( $res ){
    		return redirect('help_module');
    	}
        return view('admin.error', ['body_style' => 'error-page', 'message' => '新增模块失败，请重试']);
    }

    /**
     * 更新
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update(Request $request)
    {
    	$id = $request->input('id');
    	$result = $this->help_class_object->getDataById($id);

    	$data = array(
    		'data' => $result
    		);
    	return view('admin.help.show_module', $data);
    }

    /**
     * 更新写入
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function doUpdate(Request $request)
    {
    	$res = $this->help_class_object->saveData($request->all());
    	if( $res ){
    		return redirect('help_module');
    	}
    	return view('admin.error', ['body_style' => 'error-page', 'message' => '更新模块失败，请重试']);
    }

    /**
     * 删除
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function delete(Request $request)
    {
    	$id = $request->input('id');
    	$res = $this->help_class_object->deleteDataById($id);
    	if( $res ){
    		return redirect()->back();
    	}
    	return view('admin.error', ['body_style' => 'error-page', 'message' => '删除模块失败，请重试']);
    }

}
