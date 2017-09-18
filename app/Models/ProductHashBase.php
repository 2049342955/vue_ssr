<?php
/**
 * 商品基类设置
 * @author      mozarlee
 * @time        2017-07-11 16:28:16
 * @created by  Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductHashBase extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'product_hash_base';

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

        $object->name = $args['name']; // 产品基类名称
        $object->total_value = $args['total_value']; // 发行总量
        // $object->preserve_id = $args['preserve_id']; // 保全人id
        $object->rate_range = $args['rate_range']; // 年化收益率区间
        $object->contract_id = $args['contract_id']; // 对应合同模板id
        // $object->product_tpl_id = $args['product_tpl_id']; // 产品上线公告模板id
        $object->modify_user = $args['modify_user']; // 操作员
        $object->modify_time = $args['modify_time']; // 添加时间
        $object->about_week_income = $args['about_week_income']; // 预期每7天收益

        // 新增币种类型字段
        $object->product_hash_type = $args['product_hash_type']; // 预期每7天收益

        
        $res = $object->save();
        return $res;
    }

    /**
     * 分页获取所有数据
     * @return [type] [description]
     */
    public function getAll()
    {
        $result = self::orderBy('id', 'desc')
                    ->paginate($this->page);
        if (!empty($result)) {
            // 处理返回结果数据格式
            $result = $this->dealResults($result);
        }
        return $result;
    }

    /**
     * 获取全部数据
     * @return [type] [description]
     */
    public function getAllArr()
    {
        $result = self::select('id', 'name')
                    ->orderBy('id', 'desc')
                    ->get()
                    ->toArray();
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

}
