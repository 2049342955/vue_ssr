<?php
/**
 * 算力租赁订单
 * 
 * @author                  mozarlee
 * @time                    2017-02-23 10:57:03
 * @created by              Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductHash extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'product_hash';

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
     * 关联基类
     * @return [type] [description]
     */
    public function product_base()
    {
        return $this->hasOne('App\Models\ProductHashBase', 'id', 'product_base_id');
    }

    /**
     * 关联算力类型
     * @return [type] [description]
     */
    public function hashtype()
    {
        return $this->hasOne('App\Models\ProductHashType', 'id', 'product_hash_type');
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
        $args->create_time = date('Y-m-d H:i:s', $args->create_time);
        $args->publish_time = date('Y-m-d H:i:s', $args->publish_time);

        // 处理时间格式
        $sell_start_time = $args->sell_start_time;
        $args->sell_start_time = date('Y-m-d H:i:s', $sell_start_time);
        $args->sell_start_time2 = date('Y-m-d H:i', $sell_start_time);
        $args->sell_start_time2 = str_replace(' ', 'T', $args->sell_start_time2);

        $sell_end_time = $args->sell_end_time;
        $args->sell_end_time = date('Y-m-d H:i:s', $sell_end_time);
        $args->sell_end_time2 = date('Y-m-d H:i', $sell_end_time);
        $args->sell_end_time2 = str_replace(' ', 'T', $args->sell_end_time2);

        $income_start_time = $args->income_start_time;
        $args->income_start_time = date('Y-m-d H:i:s', $income_start_time);
        $args->income_start_time2 = date('Y-m-d H:i', $income_start_time);
        $args->income_start_time2 = str_replace(' ', 'T', $args->income_start_time2);

        $income_end_time = $args->income_end_time;
        $args->income_end_time = date('Y-m-d H:i:s', $income_end_time);
        $args->income_end_time2 = date('Y-m-d H:i', $income_end_time);
        $args->income_end_time2 = str_replace(' ', 'T', $args->income_end_time2);

        $args->period_days = $args->period / 86400;
        return $args;
    }
/************************************************************************/

    /**
     * 分页获取所有数据
     * @return [type] [description]
     */
    public function getAll()
    {
        $result = self::orderBy('status', 'asc')
                    ->orderBy('is_top', 'desc')
                    ->orderBy('sell_start_time', 'desc')
                    ->with('product_base')
                    ->with('hashtype')
                    ->paginate($this->page);
        // 处理返回结果数据格式
        if (!empty($result)) {
            // 处理返回结果数据格式
            $result = $this->dealResults($result);
        }
        return $result;
    }

    /**
     * 根据产品名称查询
     * @return [type] [description]
     */
    public function search($search)
    {
        $result = self::where("name", "like", '%'.$search.'%')
                    ->orderBy('status', 'asc')
                    ->orderBy('is_top', 'desc')
                    ->orderBy('sell_start_time', 'desc')
                    ->with('product_base')
                    ->with('hashtype')
                    ->paginate($this->page);
        if (!empty($result)) {
            // 处理返回结果数据格式
            $result = $this->dealResults($result);
        }
        return $result;
    }

    /**
     * 根据id获取数据
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDataById($id)
    {
        $result = self::find($id);
        if (!empty($result)) {
            $result = $result->dealResult($result);
            $result = $result->toArray();
        }
        return $result;
    }

    /**
     * 修改是否放置在首页
     * @param  [type] $id     [description]
     * @param  [type] $is_top [description]
     * @return [type]         [description]
     */
    public function changeTop($id, $is_top)
    {
        $result = self::find($id);
        if (empty($result)) {
            return false;
        }

        $result->is_top = $is_top;
        $res = $result->save();
        return $res;
    }

    /**
     * 修改产品状态
     * @param  [type] $id     [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function changeStatus($id, $status)
    {
        $result = self::find($id);
        if (empty($result)) {
            return false;
        }

        $result->status = $status;
        $res = $result->save();
        return $res;
    }

    /**
     * 保存数据
     * @param  [type] $args [description]
     * @return [type]       [description]
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
            $object->create_time = time();
            $object->publish_time = time();
        }

        $object->status = 1;
        
        $object->name = $args['name'];
        $object->english_name = $args['english_name'];
        $object->russian_name = $args['russian_name'];
        $object->product_base_id = $args['product_base_id'];
        $object->sell_start_time = $args['sell_start_time'];
        $object->sell_end_time = $args['sell_end_time'];
        $object->income_start_time = $args['income_start_time'];
        $object->income_end_time = $args['income_end_time'];
        $object->period = $args['income_end_time'] - $args['income_start_time'];
        $object->amount = $args['amount'];
        $object->one_amount_value = $args['one_amount_value'];
        $object->buy_min_amount = $args['buy_min_amount'];
        $object->buy_step_amount = $args['buy_step_amount'];
        $object->single_limit_amount = $args['single_limit_amount'];
        $object->user_limit_amount = $args['user_limit_amount'];
        $object->buy_only_new_user = $args['buy_only_new_user'];
        $object->assign_mode = $args['assign_mode'];
        $object->assign_freeze_period = $args['assign_freeze_period'];
        $object->income_start_mode = $args['income_start_mode'];
        $object->power_fee = $args['power_fee'];
        $object->contract_ids = $args['contract_ids'];
        // 新增算力类型
        $object->product_hash_type = $args['product_hash_type'];

        $res = $object->save();
        return $res;
    }

}
