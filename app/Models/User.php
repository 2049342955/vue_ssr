<?php
/**
 * 会员管理
 * 
 * @author                  mozarlee
 * @time                    2017-02-23 10:57:12
 * @created by              Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'user';

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
        $args->register_time = date('Y-m-d H:i:s', $args->register_time);
        $args->last_login_time = date('Y-m-d H:i:s', $args->last_login_time);
        $args->mobile = dealStrHidden($args->mobile);
        $args->old_mobile = $args->mobile;
        $args->idcard = dealStrHidden($args->idcard, 6, 11);
        return $args;
    }
    
/************************************************************************/

    /**
     * 分页获取所有数据
     * @return [type] [description]
     */
    public function getAll()
    {
        $result = self::orderBy('last_login_time', 'desc')
                    ->orderBy('register_time', 'desc')
                    ->paginate($this->page);
        if (!empty($result)) {
            // 处理返回结果数据格式
            $result = $this->dealResults($result);
        }
        return $result;
    }

    /**
     * 根据手机号或者真实姓名查询
     * @return [type] [description]
     */
    public function search($search)
    {
        $result = self::where("mobile", "=", $search)
                    ->orWhere("truename", "=", $search)
                    ->orderBy('last_login_time', 'desc')
                    ->orderBy('register_time', 'desc')
                    ->paginate($this->page);
        if (!empty($result)) {
            // 处理返回结果数据格式
            $result = $this->dealResults($result);
        }
        return $result;
    }

    /**
     * 根据id查询
     * @param  [type] $mobile [description]
     * @return [type]         [description]
     */
    public function getMsgById($id)
    {
        $result = self::find($id);
        if (!empty($result)) {
            // 处理返回结果数据格式
            $result = $result->toArray();
        }
        return $result;
    }

    /**
     * 根据手机号码查询
     * @param  [type] $mobile [description]
     * @return [type]         [description]
     */
    public function getMsgByMobile($mobile)
    {
        $result = self::where("mobile", "=", $mobile)
                    ->first();
        if (!empty($result)) {
            // 处理返回结果数据格式
            $result = $result->toArray();
        }
        return $result;
    }

    /**
     * 提现成功，删除冻结资金
     * @return [type] [description]
     */
    public function withdrawDone($id, $amount)
    {
        $object = self::find($id);
        if (empty($object)) {
            return false;
        }

        if ($object->freeze_account - $amount < 0) {
            return false;
        }
        
        $object->freeze_account = $object->freeze_account - $amount;
        return $object->save();
    }

    /**
     * 取消提现
     * @param  [type] $id     [description]
     * @param  [type] $amount [description]
     * @return [type]         [description]
     */
    public function cancelWithdraw($id, $amount)
    {
        $object = self::find($id);
        if (empty($object)) {
            return false;
        }

        if ($object->freeze_account - $amount < 0) {
            return false;
        }
        
        $object->freeze_account = $object->freeze_account - $amount;
        $object->balance_account = $object->balance_account + $amount;
        return $object->save();
    }

    /**
     * 根据主键更新btc余额
     * @return [type] [description]
     */
    // public function updateBtcBalanceById($id, $amount)
    // {
    //     $object = self::find($id);
    //     if (empty($object)) {
    //         return false;
    //     }

    //     $object->btc_account = $object->btc_account + $amount;
    //     return $object->save();
    // }

    /**
     * 提币成功，删除冻结资金
     * @return [type] [description]
     */
    // public function withdrawBtcDone($id, $amount)
    // {
    //     $object = self::find($id);
    //     if (empty($object)) {
    //         return false;
    //     }

    //     if ($object->freeze_btc_withdraw_account - $amount < 0) {
    //         return false;
    //     }
        
    //     $object->freeze_btc_withdraw_account = $object->freeze_btc_withdraw_account - $amount;
    //     return $object->save();
    // }

    /**
     * 取消打币
     * @return [type] [description]
     */
    // public function cancelWithdrawBtc($id, $amount)
    // {
    //     $object = self::find($id);
    //     if (empty($object)) {
    //         return false;
    //     }

    //     if ($object->freeze_btc_withdraw_account - $amount < 0) {
    //         return false;
    //     }
        
    //     $object->freeze_btc_withdraw_account = $object->freeze_btc_withdraw_account - $amount;
    //     $object->btc_account = $object->btc_account + $amount;
    //     return $object->save();
    // }

    /**
     * 登陆禁止，解禁
     * @param  [type] $user_id [description]
     * @param  [type] $status  [description]
     * @return [type]          [description]
     */
    public function forbidLogin($user_id, $status)
    {
        $result = self::find($user_id);
        $result->forbid_login = $status;
        return $result->save();
    }

    /**
     * 提现禁止，解禁
     * @param  [type] $user_id [description]
     * @param  [type] $status  [description]
     * @return [type]          [description]
     */
    public function forbidWithdraw($user_id, $status)
    {
        $result = self::find($user_id);
        $result->forbid_withdraw = $status;
        return $result->save();
    }

    /**
     * 交易禁止，解禁
     * @param  [type] $user_id [description]
     * @param  [type] $status  [description]
     * @return [type]          [description]
     */
    public function forbidTrade($user_id, $status)
    {
        $result = self::find($user_id);
        $result->forbid_trade = $status;
        return $result->save();
    }
}
