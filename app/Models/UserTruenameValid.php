<?php
/**
 * 用户实名认证
 * @author      mozarlee
 * @time        2017-07-11 14:48:33
 * @created by  Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTruenameValid extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'user_truename_valid_log';

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
        $args->add_time = date('Y-m-d H:i:s', $args->add_time);
        $args->res_time = date('Y-m-d H:i:s', $args->res_time);
        $args->idcard = dealStrHidden($args->idcard, 6, 11);
        $args->old_idcard = $args->idcard;
        return $args;
    }
    
/************************************************************************/

    /**
     * 分页获取所有数据
     * @return [type] [description]
     */
    public function getAll()
    {
        $result = self::orderBy('id', 'desc')
                    ->paginate($this->page);
        // 处理返回结果数据格式
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
        $result = self::where("truename", "=", $search)
                    ->orderBy('req_time', 'desc')
                    ->paginate($this->page);
        // 处理返回结果数据格式
        if (!empty($result)) {
            // 处理返回结果数据格式
            $result = $this->dealResults($result);
        }
        return $result;
    }

    /**
     * 修改认证状态
     * @param  [type] $user_id [description]
     * @param  [type] $status  [description]
     * @return [type]          [description]
     */
    public function updateStatus($user_id, $status)
    {
        $result = self::find($user_id);
        $result->status = $status;
        return $result->save();
    }
}
