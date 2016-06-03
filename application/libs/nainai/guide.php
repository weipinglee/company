<?php
/**
 * 配置管理
 * User: weipinglee
 * Date: 2016/5/28
 * Time: 11:23
 */
namespace nainai;
use \Library\M;
use \Library\tool;
use \Library\thumb;
class guide extends base{

    protected $table = 'nav';

    protected static $navType = array('middle','top','bottom');
    public static $navText = array('主导航','顶部导航','底部导航');
    protected $rules = array(
        array('id','number','错误',0,'regex'),
        array('module','/^[a-zA-Z_]{2,30}$/u','格式错误',2,'regex'),
        array('nav_name','s{2,10}','导航名格式错误',0,'regex'),
        array('guide','/^[\S]{0,100}$/','格式错误',0,'regex'),
        array('parent_id','number','格式错误',0,'regex'),
        array('type',array('middle','bottom','top'),'类型格式错误',0,'in'),
        array('sort','number','格式错误',0,'regex'),
    );



    /**
     * 检查类型是否正确，不正确返回第一个类型
     * @param $type
     * @return mixed
     */
    public function checkType($type){
        if(in_array($type,self::$navType))
            return $type;
        return self::$navType[0];
    }

    /**
     * 获取导航类型
     * @return array
     */
    public static function getType(){
        return self::$navType;
    }

    public static function getTypeText(){
        return self::$navText;
    }

    public function getNavDetail($id){
        $obj = new M('nav');
        $data = $obj->where(array('id'=>$id))->getObj();
        if(!empty($data)){
            $data['nav_list'] = $this->getNavList($data['type'],1);
            if($data['module']!='')
                $data['link'] = \Library\url::createUrl($data['module']);
            else
                $data['link'] = $data['guide'];
            return $data;
        }
        return array();

    }

    /**
     * 获取相应类型的导航
     * @param string $type
     * @param int $show 显示方式，0：不缩进，1：下级分类缩进
     * @return array
     */
    public function getNavList($type,$show='0'){

        if(in_array($type,self::$navType)){
            $obj = new M('nav');
            $navList = $obj->where(array('type'=>$type))->order('sort asc')->select();
            $navList = $this->generateTree($navList);
            if($show==1){
                foreach($navList as $k=>$v){
                    if($v['level']!=0){
                        $navList[$k]['nav_name'] = str_repeat('--',$v['level']).$navList[$k]['nav_name'];
                    }
                }
            }

            return $navList;
        }
        return tool::getSuccInfo(0,'类型不存在');
    }

    /**
     * 获取递归数组
     * @param array $items
     * @param int $pid 父类id
     * @param int $level 分类层级，顶级分类为0
     * @return array
     */
    private  function generateTree(&$items,$pid=0,$level=0){
        static $tree = array();
        foreach($items as $key=>$item){
            if($item['parent_id']==$pid && !isset($items[$key]['del'])){
                $v = $items[$key];
                $v['level'] = $level;
                $tree[] = $v;
                $items[$key]['del']=1;
                $this->generateTree($items,$item['id'],$level+1);
            }
        }
        return $tree;
    }

}