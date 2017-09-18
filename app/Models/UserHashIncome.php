<?php
/**
 * 算力每日收益总表
 * 
 * @author                  mozarlee
 * @time                    2017-02-23 10:57:20
 * @created by              Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\UserHashIncomeDetails;
use App\Models\User;
use App\Models\UserExt;
use App\Models\UserCapital;
use App\Models\OrderHash;
use DB;
class UserHashIncome extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'user_hash_income';

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
        if (!empty($args->mine_time)){
            $args->mine_time = date('Y-m-d H:i:s', $args->mine_time);
        }
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
                    ->orderBy('id', 'desc')
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
     * 根据id获取数据
     * @param  [type] $id [description]
     * @return [type]     [description]
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
     * 录入收益数据
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function saveIncome($args)
    {
        $object = null;
        if( isset($args['id']) && !empty($args['id']) ){
            // 更新
            $object = self::find($args['id']);
            if( empty($object) ){
                return false;
            }
        }else{
            return false;
        }

        $object->mine_amount = $args['mine_amount'];
        $object->electricity_fees = $args['electricity_fees'];
        $object->mine_user = $args['mine_user'];
        $object->mine_time = $args['mine_time'];
        $object->status = 1;
        $res = $object->save();
        return $res;
    }

    /**
     * 分配
     * @param  [type] $id     [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function apportion($id, $status)
    {
        $result = self::find($id);
        if (empty($result)) {
            return false;
        }

        $result->status = $status;
        $result->apportion_time = time();
        $res = $result->save();
        return $res;
    }

    /**
     * 分配审核通过
     * user_hash_income审核状态，审核用户，审核时间
     * user_hash_income_details审核状态修改
     * @return [type] [description]
     */
    public function checkAccess($args)
    {
        // 事务处理
        DB::beginTransaction();
        try{

            // user_hash_income审核状态，审核用户，审核时间
            $object = self::find($args['id']);
            $object->audit_user = $args['audit_user'];
            $object->audit_time = $args['audit_time'];
            $object->status = 4;
            $res = $object->save();
            if (!$res) {
                throw new \Exception("Failed");
            }

            // user_hash_income_details审核状态修改为已审核
            $hash_income_details_object = new UserHashIncomeDetails();
            $res = $hash_income_details_object->checkAccess($args['id'], 1);
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
     * 转账
     * 修改user表中用户余额btc_account
     * 修改user_hash_income表中distribution_user, distribution_time, status
     * 修改user_hash_income_details表中paid_time, paid_amount, status->2
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function transfer($args)
    {        
        // 事务处理
        DB::beginTransaction();
        try{
            $hash_income_details_object = new UserHashIncomeDetails();
            $income_details_data = $hash_income_details_object->getArrByIncomeid($args['id']);
            if (!empty($income_details_data)) {
                // $user_object = new User();
                $user_ext_object = new UserExt();
                $user_capital_object = new UserCapital();
                $order_hash_object = new OrderHash();
                foreach ($income_details_data as $key => $value) {
                    // // 推广奖励，扣除奖励金到邀请人账户
                    // $reward_fee = 0.01 * $value['payable_amount']; // 奖励金额
                    // // 奖励金到邀请人账户，如果没有邀请人账户，则剩余收益为原来的数额
                    // $invite_user_id = null;

                    // if (isset($value['user']) && !empty($value['user']['invite_phone'])) {
                    //     $invite_user = $user_object->getMsgByMobile($value['user']['invite_phone']);

                    //     $invite_user_id = $invite_user['id'];
                    //     unset($invite_user);

                    //     // 修改user表中用户余额btc_account
                    //     $res = $user_object->updateBtcBalanceById($invite_user_id, $reward_fee);
                    //     if (!$res) {
                    //         throw new \Exception("Failed");
                    //     }

                    //     // 保存奖励记录到user_captial
                    //     $res = $user_capital_object->saveReward($invite_user_id, $value, $reward_fee);
                    //     if (!$res) {
                    //         throw new \Exception("Failed");
                    //     }
                    // } else {
                    //     $reward_fee = 0;
                    // }
                    $reward_fee = 0;
                    $remain_fee = $value['payable_amount'] - $reward_fee; // 剩余收益

                    // 新增币类型，给不同类型的账户打币
                    // 剩余金额到收益账户
                    // 修改user表中用户余额btc_account
                    $res = $user_ext_object->updateBtcBalanceById($value['user_id'], $remain_fee, $value['product_hash_type']);
                    if (!$res) {

                        throw new \Exception("Failed");
                    }

                    //修改order_hash表实际收益

                    $res1 = $order_hash_object->updateIncome($value['order_hash_id'], $remain_fee);
                    if (!$res1) {

                        throw new \Exception("Failed");
                    }

                    // 修改user_hash_income_details表中paid_amount为实际支付btc
                    // 修改user_hash_income_details表中paid_time, paid_amount, status->2
                    $res = $hash_income_details_object->transferDone($value['id'], 2, $remain_fee);
                    if (!$res) {

                        throw new \Exception("Failed");
                    }
                }
            }

            // 修改user_hash_income表中distribution_user, distribution_time, status
            $object = self::find($args['id']);
            $object->distribution_user = $args['distribution_user'];
            $object->distribution_time = $args['distribution_time'];
            $object->status = 5;
            $res = $object->save();
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
     * 修改状态
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
}
