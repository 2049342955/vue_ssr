<?php
/**
 * 合同模板
 *
 * @author                  mozarlee
 * @time                    2017-02-23 10:56:50
 * @created by              Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractTpl extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'contract_tpl';

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
     * 获取编辑合同人员信息
     * @return [type] [description]
     */
    public function admin()
    {
        return $this->hasOne('App\Models\Admin', 'phone', 'modify_user');
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
     * 分页获取所有数据
     * @return [type] [description]
     */
    public function getAll()
    {
        $result = self::orderBy('modify_time', 'desc')
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
        if( !empty($result) ){
            $result = $result->toArray();
        }
        return $result;
    }

    /**
     * 获取所有合同模板
     * @return [type] [description]
     */
    public function getAllArr()
    {
        $result = self::select('id', 'title_buy')
                    ->orderBy('id', 'desc')
                    ->get()
                    ->toArray();
        return $result;
    }

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

        $object->modify_user = $args['modify_user'];
        $object->modify_time = $args['modify_time'];

        if ($args['contract_type'] == 0) {
            // 购买协议
            $object->title_buy = $args['title'];
            $object->content = $args['content'];
            $object->title_transfer = "";
            $object->transfer_content = "";
        } elseif ($args['contract_type'] == 1) {
            // 转让协议
            $object->title_transfer = $args['title'];
            $object->transfer_content = $args['content'];
            $object->title_buy = "";
            $object->content = "";
        }

        $res = $object->save();
        return $res;
    }

}
