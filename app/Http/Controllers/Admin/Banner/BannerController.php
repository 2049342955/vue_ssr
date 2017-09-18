<?php

/**
 * Banner设置
 * 
 * @author      mozarlee
 * @time        2017-07-11 10:32:41
 * @created by  Sublime Text 3
 */
namespace App\Http\Controllers\Admin\Banner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Banner;

class BannerController extends Controller
{

    private $banner_object;

    function __construct()
    {
        $this->banner_object = new Banner();
    }

    /**
     * banner列表
     * @return [type] [description]
     */
    public function index(Request $request)
    {
        $result = $this->banner_object->getBanners();
    	$data = array(
    		'data' => $result,
    		);
        return view('admin.banner.showBannerList', $data);
    }

    /**
     * 创建、更新banner
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function showSaveBanner(Request $request)
    {
        $id = $request->input("id");
        $data = array();

        if (!empty($id)) {
            // 更新
            $data = $this->banner_object->getBannerById($id);
        }

        $result = array(
            "data" => $data
            );
        return view('admin.banner.saveBanner', $result);
    }

    /**
     * 保存banner
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function saveBanner(Request $request)
    {
        $id = $request->input("id");

        $file = $request->file('image');
        $url = "";
        if( !empty($file) ){
            $time = time();
            $path = 'storage/upload';
            $imageName = date('Ymd', $time).$time.'.'.$file->getClientOriginalExtension();
            $res = $file->move(base_path().'/'.$path,$imageName);
            $url = $path.'/'.$imageName;
        } else if(!empty($request->input('old_image'))) {
            $url = $request->input('old_image');
        }

        $params = $request->all();
        $params["image"] = $url;

        $res = $this->banner_object->saveBanner($params);
        if ($res) {
            return redirect()->back();
        }
        return view('admin.error', ['body_style' => 'error-page', 'message' => '写入失败，请重试']);
    }

    /**
     * 删除banner
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteBanner(Request $request) 
    {
        $id = $request->input('id');
        if (!empty($id)) {
            $res = $this->banner_object->deleteBanner($id);
            if (!$res) {
                return view('admin.error', ['body_style' => 'error-page', 'message' => '删除失败，请重试']);
            }
        }
        return redirect()->back();
    }

}
