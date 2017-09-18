<?php
/**
 * banner
 *
 * @author      mozarlee
 * @time        2017-07-11 10:37:47
 * @created by  Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'banner';

    /**
     * 主键
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 模型日期列的存储格式
     *
     * @var string
     */
    // protected $dateFormat = 'U';

    /**
     * 当前model连接数据库名称
     *
     * @var string
     */
    // protected $connection = 'connection-name';

    // 分页每页显示数据条数
    private $page = 15;

    /**
     * 处理数据格式 多条
     * @return [type] [description]
     */
    private function dealResults($args)
    {
        foreach ($args as $key => $value) {
            $args[$key] = $this->dealResult($value);
        }
        return $args;
    }

    /**
     * 处理数据格式 单条
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    private function dealResult($args)
    {
        return $args;
    }

/************************************************************************/

    /**
     * 获取首页banner图
     * @return [type] [description]
     */
    public function getBanners()
    {
        $result = self::orderBy("position", "asc")
                    ->paginate($this->page);
        return $result;
    }

    /**
     * 根据id获取banner信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getBannerById($id)
    {
        $result = self::find($id);
        if (!empty($result)) {
            $result = $result->toArray();
        }
        return $result;
    }

    /**
     * save
     * @param  [type] $id     [description]
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public function saveBanner($args)
    {
        $object = null;
        if( isset($args['id']) && !empty($args['id']) ){
            // 更新
            $object = self::find($args['id']);
            if( empty($object) ){
                return false;
            }
        }else{
            // 新增
            $class_name = get_class();
            $object = new $class_name;
        }

        $object->image = $args['image'];
        $object->title = $args['title'];
        $object->url = $args['url'];
        $object->url_type = $args['url_type'];
        $object->url_id = 0;
        $object->endpoint = $args['endpoint'];
        $object->position = $args['position'];
        $object->remark = $args['remark'];
        $object->display_order = $args['display_order'];
        $res = $object->save();
        return $res;
    }

    /**
     * 删除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteBanner($id)
    {
        $res = self::where('id', '=', $id)->delete();
        return $res;
    }

}
