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
class member extends base{

    protected $table = 'member';

    protected $pk = 'id';
    protected $rules = array(
        array('id','number','错误',0,'regex'),
        array('no','require','会员号错误',0,'regex'),
        array('name','require','姓名错误',0,'regex'),
        array('identify_no','require','身份证错误',0,'regex'),
        array('create_person','require','创建人错误',0,'regex'),
        array('create_time','require','创建时间错误',0,'regex'),
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

        if(isset($search['keyword']) && $search['keyword']!=''){
            $where1 =  'name like "%'.$search['keyword'].'%" OR no like "%'.$search['keyword'].'%"';
            $where .= $where =='' ? $where1 : ' AND '.$where1;
        }

        if($where!=''){
            $Q->where = $where;
        }

        $data = $Q->find();
        $pageBar =  $Q->getPageBar();


        return array('data'=>$data,'bar'=>$pageBar);
    }





}