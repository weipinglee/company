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
class product extends base{

    protected $table = 'product';
    protected $imgTable = 'images';
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
        $Q = new Query('product');
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
            $where1 =  'name like "%'.$search['keyword'].'%"';
            $where .= $where =='' ? $where1 : ' AND '.$where1;
        }

        if($where!=''){
            $Q->where = $where;
        }

        $data = $Q->find();
        $pageBar =  $Q->getPageBar();
        $cateObj = new \nainai\proCategory();
        if(!empty($data)){
            foreach($data as $k=>$v){
                $data[$k]['cat_text'] = $cateObj->getCateText($v['cat_id']);
                $data[$k]['add_time'] = \Library\Time::getDateTime('Y-m-d',$data[$k]['add_time']);
            }
        }

        return array('data'=>$data,'bar'=>$pageBar);
    }

    public function updateProduct($product,$imgData){
        $obj = new M($this->table);
        $obj->beginTrans();

        if($obj->validate($this->rules,$product)){
            if(isset($product[$this->pk]) && $product[$this->pk]>0){
                $id = $product[$this->pk];
               // unset($product[$this->pk]);

                $this->update($product);
            }
            else{
                $res = $this->add($product);
                $id = $res['info'];
            }
            $obj->table($this->imgTable);
            $imgArr = array();
            $obj->where(array('product_id'=>$id,'type'=>'product'))->delete();
            if(!empty($imgData)){
                foreach($imgData as $k=>$v){
                    $imgArr[$k]['file'] = $v;
                    $imgArr[$k]['type'] = 'product';
                    $imgArr[$k]['product_id'] = $id;
                }

                $obj->data($imgArr)->adds();
            }
            $res = $obj->commit();
            if($res===true){
                return tool::getSuccInfo();
            }
            else{
                return tool::getSuccInfo(0,'操作失败');
            }


        }
        else{
            return tool::getSuccInfo(0,$obj->getError());
        }
    }

    public function  getProductImages($id){
        $obj = new M($this->imgTable);
        $data = $obj->where(array('product_id'=>$id,'type'=>'product'))->select();
        foreach($data as $k=>$v){
            $data[$k]['thumb'] = thumb::get($v['file'],100,100);
        }
        return $data;
    }





}