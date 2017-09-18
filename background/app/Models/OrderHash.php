<?php
/**
 * 算力租赁订单
 * 
 * @author                  mozarlee
 * @time                    2017-02-23 10:56:59
 * @created by              Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHash extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'order_hash';

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
     * 获取用户信息
     * @return [type] [description]
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id')
                    ->select('id', 'truename', 'mobile', 'email', 'user_verified');
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
        $args->income_start_time = date('Y-m-d H:i:s', $args->income_start_time);
        $args->income_end_time = date('Y-m-d H:i:s', $args->income_end_time);
        $args->last_income_time = date('Y-m-d H:i:s', $args->last_income_time);
        $args->next_income_time = date('Y-m-d H:i:s', $args->next_income_time);
        $args->pay_success_time = date('Y-m-d H:i:s', $args->pay_success_time);
        return $args;
    }
/************************************************************************/

    /**
     * 分页获取所有数据
     * @return [type] [description]
     */
    public function getAll()
    {
        $result = self::whereIn( 'status', array(2, 3, 6, 7, 8, 9) )
                    ->orderBy('status', 'desc')
                    ->orderBy('pay_success_time', 'desc')
                    ->with('user')
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
     * 查询
     * @return [type] [description]
     */
    public function searchData($args)
    {

    }

    /*更新realized_income_value 加入实现收入*/
    public function updateIncome($id,$amount)
    {
       $object = self::find($id);
        if( empty($object) ){
            return false;
        } else{
            
            $object->realized_income_value = $object->realized_income_value + $amount ;
         
            $res = $object->save();
            return $res;  
        }      
    }

}
