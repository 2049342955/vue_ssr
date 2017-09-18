<?php
/**
 * 算力每日收益总表
 * 
 * @author                  mozarlee
 * @time                    2017-02-23 10:57:27
 * @created by              Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;
use App\Models\UserHashIncome;

class UserHashIncomeDetails extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'user_hash_income_details';

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
     * 获取用户信息
     * @return [type] [description]
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id')
                    ->select('id', 'truename', 'mobile', 'email', 'user_verified', 'invite_phone');
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
        $args->payable_time = date('Y-m-d H:i:s', $args->payable_time);
        $args->compute_time = date('Y-m-d H:i:s', $args->compute_time);
        return $args;
    }
    
/************************************************************************/

    /**
     * 分页获取所有数据
     * @return [type] [description]
     */
    public function getAll()
    {
        $result = self::orderBy('payable_time', 'desc')
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
     * 根据算力收益主表主键查询记录
     * @param  [type] $hash_income_id [description]
     * @return [type]                 [description]
     */
    public function getArrByIncomeid($hash_income_id)
    {
        $data = self::select('id', 'payable_amount', 'user_id', 'product_hash_type','order_hash_id')
                    ->where('hash_income_id', '=', $hash_income_id)
                    ->orderBy('id', 'desc')
                    ->with('user')
                    ->with('hashtype')
                    ->get()->toArray();
        return $data;
    }

    /**
     * 获取某个用户已经收到的btc总额
     * @param  [type] $user_id [description]
     * @param  [type] $status  [description]
     * @return [type]          [description]
     */
    public function getUserBtcSum($user_id, $status)
    {
        $data = self::where('user_id', '=', $user_id)
                    ->where('status', '=', $status)
                    ->sum('paid_amount');
        return $data;
    }

    /**
     * 根据时间范围获取指定状态的收益数据
     * @param  [type] $start  [description]
     * @param  [type] $end    [description]
     * @param  [type] $type   [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function getDataByRange($start, $end, $status)
    {
        $result = self::where('status', '=', $status)
                    ->where('payable_time', '>=', $start)
                    ->where('payable_time', '<', $end)
                    ->with('user')
                    ->with('hashtype')
                    ->paginate($this->paginate);
        // 处理返回结果数据格式
        if (!empty($result)) {
            // 处理返回结果数据格式
            $result = $this->dealResults($result);
        }
        return $result;
    }

    /**
     * 根据时间范围获取指定状态的收益总数据数据
     * @param  [type] $start  [description]
     * @param  [type] $end    [description]
     * @param  [type] $type   [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function getTotalBtcByRange($start, $end, $status)
    {
        $result = self::where('status', '=', $status)
                    ->where('payable_time', '>=', $start)
                    ->where('payable_time', '<', $end)
                    ->sum('paid_amount');
        return $result;
    }

    /**
     * * 分配到每个用户的记录user_hash_income_details
     * 修改user_hash_income状态为已分配
     * @param  [type] $hash_income_id [user_hash_income主键id]
     * @param  [type] $mine_amount    [实际收益]
     * @param  [type] $hash_total     [产品总数量]
     * @return [type]                 [description]
     */
    public function updateIncome($hash_income_id, $mine_amount, $hash_total)
    {   
        $hash_income_data = self::select('id', 'hold_amount')
                                ->orderBy('id', 'desc')
                                ->where('hash_income_id', '=', $hash_income_id)
                                ->get()->toArray();
        // 事务处理
        DB::beginTransaction();
        try{

            foreach ($hash_income_data as $key => $value) {
                // 将相应的收益分配到每个用户
                $object = self::find($value['id']);
                $object->payable_amount = round($value['hold_amount'] * $mine_amount / $hash_total, 8);
                $ret = $object->save();

                if (!$ret) {
                    throw new \Exception("Failed");
                }
            }

            // 修改user_hash_income状态为已分配
            $hash_income_object = new UserHashIncome();
            $res = $hash_income_object->apportion($hash_income_id, 3);
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
     * user_hash_income_details审核状态修改为已审核
     * @param  [type] $hash_income_id [description]
     * @param  [type] $status         [description]
     * @return [type]                 [description]
     */
    public function checkAccess($hash_income_id, $status)
    {
        $res = self::where('hash_income_id', '=', $hash_income_id)->get()->toArray();
        if (empty($res)) {
            return true;
        }

        $res = self::where('hash_income_id', '=', $hash_income_id)
                    ->update(['status' => $status]);
        return $res;
    }

    /**
     * 转账完成
     * 修改user_hash_income_details表中paid_time, paid_amount, status->2
     * @param  [type] $id     [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function transferDone($id, $status, $paid_amount)
    {
        $object = self::find($id);
        if (empty($object)) {
            return false;
        }

        $object->paid_time = time();
        $object->paid_amount = $paid_amount;
        $object->status = $status;
        return $object->save();
    }
}
