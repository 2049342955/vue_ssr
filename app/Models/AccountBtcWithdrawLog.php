<?php
/**
 * 用户比特币提现记录
 * 
 * @author                  mozarlee
 * @time                    2017-02-23 10:56:07
 * @created by              Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\UserCapital;
use App\Models\UserExt;
use DB;
class AccountBtcWithdrawLog extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'account_btc_withdraw_log';

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
        $args->apply_time = date('Y-m-d H:i:s', $args->apply_time);
        $args->pay_time = date('Y-m-d H:i:s', $args->pay_time);
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
                    ->orderBy('apply_time', 'desc')
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
     * 根据手机号查询
     * @param  [type] $search [description]
     * @return [type]         [description]
     */
    public function search($search)
    {
        $user_object = new User();
        $user_data = $user_object->getMsgByMobile($search);
        if (empty($user_data)) {
            return null;
        }

        $result = self::where('user_id', '=', $user_data['id'])
                    ->orderBy('status', 'asc')
                    ->orderBy('apply_time', 'desc')
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
     * 根据用户id获取数据
     * @return [type] [description]
     */
    public function getDataByUserId($user_id)
    {
        $result = self::where('user_id', '=', $user_id)
                    ->orderBy('status', 'asc')
                    ->orderBy('apply_time', 'desc')
                    ->get();

        // 处理返回结果数据格式
        if (!empty($result)) {
            // 处理返回结果数据格式
            $result = $this->dealResults($result);
        }
        return $result;
    }

    /**
     * 审核通过进行下一步
     * account_btc_withdraw_log修改状态为处理中
     * user_capital修改状态为处理中
     * @return [type] [description]
     */
    public function checkAccess($args)
    {
        // 事务处理
        DB::beginTransaction();
        try{

            // account_btc_withdraw_log修改状态为处理中
            $object = self::find($args['id']);
            if (empty($object)) {
                throw new \Exception("Failed");
            }

            $object->status = 1;
            $res = $object->save();
            if (!$res) {
                throw new \Exception("Failed");
            }

            // user_capital修改状态为处理中
            $user_capital_object = new UserCapital();
            $res = $user_capital_object->withdrawBtc($object, 1);
            if (!$res) {
                throw new \Exception("Failed");
            }

            DB::commit();
        } catch (\Exception $e){
            DB::rollback();//事务回滚
            return false;
        }
        return true;
    }

    /**
     * 打币完成
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function transferBtcDone($args)
    {
        // 事务处理
        DB::beginTransaction();
        try{

            // 修改提币记录状态，打款人，打款时间
            $object = self::find($args['id']);
            if (empty($object)) {
                throw new \Exception("Failed");
            }

            $object->status = 2;
            $object->pay_username = $args['pay_username'];
            $object->pay_time = $args['pay_time'];
            $res = $object->save();
            if (!$res) {
                throw new \Exception("Failed");
            }

            // 账户资金变动
            $user_ext_object = new UserExt();
            $res = $user_ext_object->withdrawBtcDone($object->user_id, $object->amount, $object->product_hash_type);
            if (!$res) {
                throw new \Exception("Failed");
            }

            // user_captial提币记录修改状态
            $user_capital_object = new UserCapital();
            $res = $user_capital_object->withdrawBtc($object, 2);
            if (!$res) {
                throw new \Exception("Failed");
            }

            DB::commit();
        } catch (\Exception $e){
            DB::rollback();//事务回滚
            return false;
        }
        return true;
    }

    /**
     * 取消打币
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function cancel($args)
    {
        // 事务处理
        DB::beginTransaction();
        try{

            // 修改提币记录状态，打款人，打款时间
            $object = self::find($args['id']);
            if (empty($object)) {
                throw new \Exception("Failed");
            }

            $object->status = 3;
            $object->pay_username = $args['pay_username'];
            $object->pay_time = $args['pay_time'];
            $res = $object->save();
            if (!$res) {
                throw new \Exception("Failed");
            }

            // 账户资金变动
            $user_ext_object = new UserExt();
            $res = $user_ext_object->cancelWithdrawBtc($object->user_id, $object->amount, $object->product_hash_type);
            if (!$res) {
                throw new \Exception("Failed");
            }

            // user_captial提币记录修改状态
            $user_capital_object = new UserCapital();
            $res = $user_capital_object->withdrawBtc($object, 3);
            if (!$res) {
                throw new \Exception("Failed");
            }

            DB::commit();
        } catch (\Exception $e){
            DB::rollback();//事务回滚
            return false;
        }
        return true;
    }

}
