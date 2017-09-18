<?php

/**
 * 资讯内容管理
 * @author      mozarlee
 * @time        2017-07-11 13:18:34
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Information;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\News;
use App\Models\NewsClass;
class InformationContentController extends Controller
{
	private $news_object;

	function __construct()
	{
		$this->news_object = new News();
	}

    /**
     * 资讯内容管理首页
     * @return [type] [description]
     */
    public function index(Request $request)
    {
    	$result = $this->news_object->getAll();
    	$data = array(
    		'data' => $result
    		);
        return view('admin.information.information_content', $data);
    }

    /**
     * 新增
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function create(Request $request)
    {
    	$news_class_object = new NewsClass();
    	$cate = $news_class_object->getData();

    	$data = array(
    		'cate' => $cate
    		);
    	return view('admin.information.show_content', $data);
    }

    /**
     * 新增写入
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function doCreate(Request $request)
    {
    	$res = $this->news_object->saveData($request->all());
    	if( $res ){
    		return redirect('information/content');
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
    	$result = $this->news_object->getDataById($id);

    	$news_class_object = new NewsClass();
    	$cate = $news_class_object->getData();

    	$data = array(
    		'data' => $result,
    		'cate' => $cate
    		);
    	return view('admin.information.show_content', $data);
    }

    /**
     * 更新写入
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function doUpdate(Request $request)
    {
    	$res = $this->news_object->saveData($request->all());
    	if( $res ){
    		return redirect('information/content');
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
    	$res = $this->news_object->deleteDataById($id);
    	if( $res ){
    		return redirect()->back();
    	}
    	return view('admin.error', ['body_style' => 'error-page', 'message' => '删除内容失败，请重试']);
    }

}
