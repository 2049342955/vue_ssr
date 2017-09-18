<?php
/**
 * 用户扩展表
 * @author      mozarlee
 * @time        2017-07-17 17:52:15
 * @created by  Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExt extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'user_ext';

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
     * The connection name for the model.
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
     * 根据主键更新余额
     * @return [type] [description]
     */
    public function updateBtcBalanceById($id, $amount, $type = 1)
    {
        // 新增币类型，给不同类型的账户打币
        $object = self::where('user_id', '=', $id)
                        ->where('type', '=', $type)
                        ->first();

        if (empty($object)) {
            // 新增
            $class_name = get_class();
            $object = new $class_name;
            
            $object->coin_account = 0.00000000;
            $object->freeze_coin_account = 0.00000000;
            $object->freeze_coin_withdraw_account = 0.00000000;
            $object->type = $type;
            $object->user_id = $id;
        }

        $object->coin_account = $object->coin_account + $amount;
        return $object->save();
    }

    /**
     * 提币成功，删除冻结资金
     * @return [type] [description]
     */
    public function withdrawBtcDone($id, $amount, $type = 1)
    {
        // 新增币类型，根据不同类型的算力操作相应的账户
        $object = self::where('user_id', '=', $id)
                        ->where('type', '=', $type)
                        ->first();

        if (empty($object)) {
            return false;
        }

        if ($object->freeze_coin_withdraw_account - $amount < 0) {
            return false;
        }
        
        $object->freeze_coin_withdraw_account = $object->freeze_coin_withdraw_account - $amount;
        return $object->save();
    }

    /**
     * 取消打币
     * @return [type] [description]
     */
    public function cancelWithdrawBtc($id, $amount, $type = 1)
    {
        // 新增币类型，根据不同类型的算力操作相应的账户

        $object = self::where('user_id', '=', $id)
                        ->where('type', '=', $type)
                        ->first();
        if (empty($object)) {
            return false;
        }

        if ($object->freeze_coin_withdraw_account - $amount < 0) {
            return false;
        }
        
        $object->freeze_coin_withdraw_account = $object->freeze_coin_withdraw_account - $amount;
        $object->coin_account = $object->coin_account + $amount;
        return $object->save();
    }

}
