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
class article extends base{

    protected $table = 'article';

    protected $pk = 'id';
    protected $rules = array(
        array('id','number','错误',0,'regex'),
        array('cat_id','number','分类错误',0,'regex'),
        array('price','currency','价格错误',0,'regex'),
        array('unit','s{1,20}','单位错误',0,'regex'),
        array('name','s{2,30}','商品名错误',0,'regex'),
        array('description','s{0,255}','描述错误',0,'regex'),
        array('status','number','格式错误',0,'regex'),
        array('sort','number','格式错误',0,'regex'),
    );

    /**
     * 获取产品列表
     * @param int $page 页码
     * @param array $search 搜索条件
     * @return array
     */
    public function getList($page,$search=array()){
        $Q = new Query($this->table);
        $Q->page = $page;
        $Q->pagesize = 20;
        $where = '';
        if(isset($search['cat_id']) && $search['cat_id']>0){
            $cateObj = new proCategory();
            $cateIds = $cateObj->getChildCate($search['cat_id']);//获取所有子分类的id
            $cateIds[] = $search['cat_id'];
            $cateIds = implode(',',$cateIds);
            $where = 'cat_id in ('.$cateIds.')';
        }
        if(isset($search['keyword']) && $search['keyword']!=''){
            $where1 =  'title like "%'.$search['keyword'].'%"';
            $where .= $where =='' ? $where1 : ' AND '.$where1;
        }

        if($where!=''){
            $Q->where = $where;
        }
        $Q->fields = 'id,cat_id,title,add_time';
        $data = $Q->find();
        $pageBar =  $Q->getPageBar();
        $cateObj = new \nainai\artCategory();
        if(!empty($data)){
            foreach($data as $k=>$v){
                $data[$k]['cat_text'] = $cateObj->getCateText($v['cat_id']);
                $data[$k]['add_time'] = \Library\Time::getDateTime('Y-m-d',$data[$k]['add_time']);
            }
        }

        return array('data'=>$data,'bar'=>$pageBar);
    }





}