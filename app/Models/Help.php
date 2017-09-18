<?php
/**
 * 帮助管理
 * 
 * @author      mozarlee
 * @time        2017-02-27 10:51:46
 * @created by  Sublime Text 3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'help';

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
     * 帮助分类关联
     * @return [type] [description]
     */
    public function helpClass()
    {
        return $this->hasOne('App\Models\HelpClass', 'id', 'help_class_id');
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
        $args->dateline = date('Y-m-d', $args->dateline);
        return $args;
    }


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
            $object->dateline = time();
        }


        if (!isset($args['content'])) {
            $args['content'] = 0;
        } 

        if (!isset($args['english_content'])) {
            $args['english_content'] = 0;
        }
        
        if (!isset($args['russian_content'])) {
            $args['russian_content'] = 0;
        }

        
        $object->title = $args['title'];
        $object->english_title = $args['english_title'];

        $object->russian_title = $args['russian_title'];

        $object->help_class_id = $args['help_class_id'];
        $object->content = $args['content'];
        $object->english_content = $args['english_content'];
        $object->russian_content = $args['russian_content'];

        $object->author = $args['author'];
        // $object->top = $args['top'];
        // $object->color = $args['color'];
        // $object->bold = $args['bold'];
        $res = $object->save();
        return $res;
    }

    /**
     * 分页获取所有数据
     * @return [type] [description]
     */
    public function getAll()
    {
        $result = self::orderBy('help_class_id', 'desc')
                    ->with('helpClass')
                    ->paginate($this->page);
        if (!empty($result)) {
            // 处理返回结果数据格式
            $result = $this->dealResults($result);
        }
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
