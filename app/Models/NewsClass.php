<?php
/**
 * 资讯分类
 * @author      mozarlee
 * @time        2017-07-11 12:59:16
 * @created by  Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsClass extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'news_class';

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


/************************************************************************/

    /**
     * 新增、更新帮助分类
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

        $object->name = $args['name'];
        $object->display_order = $args['display_order'];
        $res = $object->save();
        return $res;
    }

    /**
     * 分页获取所有数据
     * @return [type] [description]
     */
    public function getAll()
    {
        $result = self::orderBy('display_order', 'desc')
                    ->paginate($this->page);
        return $result;
    }

    /**
     * 获取所有数据不分页
     * @return [type] [description]
     */
    public function getData()
    {
        $result = self::orderBy('display_order', 'desc')
                        ->get();
        return $result;
    }

    /**
     * 根据id获取数据
     * @return [type] [description]
     */
    public function getDataById($id)
    {
        $result = self::find($id);
        return $result;
    }

    /**
     * 删除
     * @return [type] [description]
     */
    public function deleteDataById($id)
    {
        $res = self::where('id', '=', $id)->delete();
        return $res;
    }

}
