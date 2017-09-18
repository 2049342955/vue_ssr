<?php

/**
 * 资讯模块管理
 * @author      mozarlee
 * @time        2017-07-11 13:18:21
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Information;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\NewsClass;
class InformationClassController extends Controller
{
	private $news_class_object;

	function __construct()
	{
		$this->news_class_object = new NewsClass();
	}

    /**
     * 资讯模块管理首页
     * @return [type] [description]
     */
    public function index(Request $request)
    {
    	$result = $this->news_class_object->getAll();

    	$data = array(
    		'data' => $result
    		);
        return view('admin.information.information_module', $data);
    }

    /**
     * 新增
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function create(Request $request)
    {
    	return view('admin.information.show_module');
    }

    /**
     * 新增写入
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function doCreate(Request $request)
    {
    	$res = $this->news_class_object->saveData($request->all());
    	if( $res ){
    		return redirect('information/module');
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
    	$result = $this->news_class_object->getDataById($id);

    	$data = array(
    		'data' => $result
    		);
    	return view('admin.information.show_module', $data);
    }

    /**
     * 更新写入
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function doUpdate(Request $request)
    {
    	$res = $this->news_class_object->saveData($request->all());
    	if( $res ){
    		return redirect('information/module');
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
    	$res = $this->news_class_object->deleteDataById($id);
    	if( $res ){
    		return redirect()->back();
    	}
    	return view('admin.error', ['body_style' => 'error-page', 'message' => '删除模块失败，请重试']);
    }

}
