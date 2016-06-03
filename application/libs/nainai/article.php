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

    protected $imgTable = 'images';

    protected $about = 'about';//企业简介类型的文章

    protected $healthy = 'healthy';

    protected $dongtai = 'dongtai';

    protected $contacts = 'contacts';

    protected $pk = 'id';
    protected $rules = array(
        array('id','number','错误',0,'regex'),
        array('cat_id','number','分类错误',0,'regex'),
        array('price','currency','价格错误',0,'regex'),
        array('unit','s{1,20}','单位错误',0,'regex'),
        array('name','s{2,30}','商品名错误',0,'regex'),
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

    /**
     * 更新或插入文章
     * @param array $article 文章数据
     * @param array $imgData 图片数据
     */
    public function updateArticle($article,$imgData){
        $obj = new M($this->table);
        $obj->beginTrans();

        if($obj->validate($this->rules,$article)){
            $res = $this->update($article);
            $id = $res['info'];
            $obj->table($this->imgTable);
            $imgArr = array();
            $obj->where(array('product_id'=>$id,'type'=>'article'))->delete();
            if(!empty($imgData)){
                foreach($imgData as $k=>$v){
                    $imgArr[$k]['file'] = $v;
                    $imgArr[$k]['type'] = 'article';
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

    public function  getArticleImages($id,$width=100,$height=100){
        $obj = new M($this->imgTable);
        $data = $obj->where(array('product_id'=>$id,'type'=>'article'))->select();
        foreach($data as $k=>$v){
            $data[$k]['thumb'] = thumb::get($v['file'],$width,$height);
        }
        return $data;
    }

    public function getArticleList($where,$width=200,$height=150){
        $obj = new Query($this->table.' as a');
        $obj->join = 'left join article_category as ac on a.cat_id = ac.cat_id';
        $obj->fields = 'a.*';
        $obj->where = $where;
        $obj->order = 'a.sort asc';
        $obj->limit = 5;
        $res = $obj->find();
        foreach($res as $k=>$v){
            $res[$k]['img'] = $this->getArticleImages($v['id'],200,150);
        }
        return $res;
    }
    /**
     * 获取企业简介的文章
     */
    public function getAboutArticle(){
        return $this->getArticleList(' ac.description="'.$this->about.'"');
    }

    /**
     * 根据分类id获取文章
     * @param $cate_id
     * @return array
     */
    public function getArticleByCateId($cate_id){
       return $this->getArticleList('ac.cat_id='.$cate_id);
    }

    public function getHealthyArticle(){
        //获取子分类
        $obj = new artCategory();
        $data = $obj->getChildByDescription($this->healthy);
        foreach($data as $key=>$val){
            foreach($val as $k=>$v){
                if(is_array($v)){
                    $data[$key][$k]['img'] = $this->getArticleImages($v['id'],640,300);
                }
            }

        }
        return $data;

    }

    /**
     * 获取动态
     * @return array
     */
    public function getDongtaiArticle(){
        return $data = $this->getArticleList('ac.description="'.$this->dongtai.'"',370,270);

    }

    public function getContactsArticle(){
        return $this->getArticleList(' ac.description="'.$this->contacts.'"');
    }

    public function getIndexArticle(){
        $m = new M($this->table);
        return $m->where(array('status'=>1,'showindex'=>1))->select();
    }







}