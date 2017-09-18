<?php
/**
 * 同一基类产品介绍
 * @author      mozarlee
 * @time        2017-07-11 17:24:54
 * @created by  Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductHashIntroduction extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'product_hash_introduce';

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
     * 关联产品基类
     * @return [type] [description]
     */
    public function product_base()
    {
        return $this->hasOne('App\Models\ProductHashBase', 'id', 'product_base_id');
    }

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
        $args->modify_time = date('Y-m-d H:i:s', $args->modify_time);
        return $args;
    }


/************************************************************************/

    /**
     * 新增、更新
     * @return bool 是否成功
     */
    public function saveData($args)
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

        $object->product_base_id = $args['product_base_id']; // 关联的产品基类id
        $object->title = $args['title']; // 产品介绍标题标签
        $object->content = $args['content']; // 产品介绍内容
        $object->display_order = 1; // 排序值
        $object->modify_user = $args['modify_user']; // 
        $object->modify_time = $args['modify_time']; // 
        $res = $object->save();
        return $res;
    }

    /**
     * 分页获取所有数据
     * @return [type] [description]
     */
    public function getAll()
    {
        $result = self::orderBy('product_base_id', 'desc')
                    ->with('product_base')
                    ->paginate($this->page);
        if (!empty($result)) {
            // 处理返回结果数据格式
            $result = $this->dealResults($result);
        }
        return $result;
    }

    /**
     * 获取某个基类产品的介绍
     * @param  [type] $base_id [description]
     * @return [type]          [description]
     */
    public function getBaseRecord($base_id) {
        $result = self::where('product_base_id', '=', $base_id)
                    ->paginate($this->page);
        if (!empty($result)) {
            $result = $this->dealResults($result);
        }
        return $result;
    }

    /**
     * 根据id获取数据
     * @return [type] [description]
     */
    public function getDataById($id)
    {
        $result = self::find($id);
        if (!empty($result)) {
            $result = $result->toArray();
        }
        return $result;
    }

    /**
     * 删除
     * @return [type] [description]
     */
    public function deleteDataById($id)
    {
        $res = self::where('id', '=', $id)->delete();
        return $res;
    }

}
