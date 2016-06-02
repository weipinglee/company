<?php
/**
 * 商品分类
 * User: weipinglee
 * Date: 2016/5/28
 * Time: 11:23
 */
namespace nainai;
use \Library\M;
use \Library\tool;
use \Library\thumb;
use \Library\Query;
class artCategory extends base{

    protected $table = 'article_category';

    protected $pk = 'cat_id';
    protected $rules = array(
        array('cat_id','number','错误',0,'regex'),
        array('cate_name','s{2,30}','分类名格式错误',0,'regex'),
        array('description','s{0,255}','描述错误',0,'regex'),
        array('parent_id','number','错误',0,'regex'),
        array('status','number','格式错误',0,'regex'),
        array('sort','number','格式错误',0,'regex'),
    );


    /**
     * 获取所有分类树
     * @param int $show 1 缩进，0：不缩进
     */
    public function getCateTree($show=0){
        $m = new M($this->table);
        $data = $m->order('sort ASC')->select();

        if($data){
            $data = $this->generateTree($data);

            if($show==1){
                foreach($data as $k=>$v){
                    if($v['level']!=0){
                        $data[$k]['cate_name'] = str_repeat('--',$v['level']).$data[$k]['cate_name'];
                    }
                }
            }
            return $data;
        }
        return array();
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
                $this->generateTree($items,$item['cat_id'],$level+1);
            }
        }
        return $tree;
    }

    /**
     * 获取分类名
     */
    public function getCateText($cat_id){
        $m = new M($this->table);
        $res = $m->where(array('cat_id'=>$cat_id))->getObj();
        return $res['cate_name'];
    }

    /**
     * 获取下级所有分类，以及下级所有第一个分类id,以逗号相隔
     * @param array
     */
    public function getChildCate($id){
         $m = new M($this->table);
        static $ids = array();
        $cateIds = $m->where(array('parent_id'=>$id))->getFields('cat_id');

        if(!empty($cateIds)){
            foreach($cateIds as $k=>$v){
                $ids[] = $v;
                $this->getChildCate($v);
            }
        }

        return $ids;

    }

    /**
     * 根据描述获取所有下级分类的文章
     * @param $des
     */
    public function getChildByDescription($des){
        $m = new M($this->table);
        $id = $m->where(array('description'=>$des))->getField('cat_id');
        if(intval($id)>0){
           $obj = new Query('article_category as ac');
            $obj->join = 'left join article as a on ac.cat_id=a.cat_id ';
            $obj->where = 'ac.parent_id = '.$id;
            $data = $obj->find();
            $res = array();
            foreach($data as $k=>$v){
                $res[$v['cat_id']]['cat_name'] = $v['cate_name'];
                $res[$v['cat_id']][] = $v;

            }
           return $res;
        }
        return array();
    }





}