<?php
/**
 * 系统配置
 * User: weipinglee
 * Date: 2016/5/27
 * Time: 20:50
 */
use \Library\safe;
use \Library\json;

class articleController extends baseController{

  public function cateListAction(){
    $this->getView()->assign('cur','articleCat');
    $this->getView()->assign('here','文章分类列表');
    $model = new \nainai\artCategory();
    $cateList = $model->getCateTree(1);

    $this->getView()->assign('list',$cateList);
  }

    public function cateAddAction(){
      $this->getView()->assign('cur','articleCat');
      $this->getView()->assign('here','编辑分类');
      $model = new \nainai\artCategory();
      if(IS_POST){
        $data = array(
            'cat_id'=> safe::filterPost('id','int',0),
            'cate_name'=> safe::filterPost('cate_name'),
            'description'=> safe::filterPost('description'),
            'parent_id' => safe::filterPost('parent_id'),
            'sort'     => safe::filterPost('sort','int'),
            'bottom'   => safe::filterPost('bottom','int')
        );

        $res = $model->update($data);
        die(json::encode($res));

      }
      else{
        $id = $this->getRequest()->getParam('id');

        if(intval($id)>0){
          $res = $model->get($id);

          $this->getView()->assign('cate',$res);
        }
        $cateList = $model->getCateTree(1);

        $this->getView()->assign('list',$cateList);
      }
    }


    /**
     * 商品分类删除
     * @return bool
     */
    public function cateDelAction(){
      if(IS_POST){
        $id = $this->getRequest()->getParam('id');
        if(intval($id)>0){
          $model = new \nainai\artCategory();
          $res = $model->delete($id);
          die(json::encode($res));

        }
      }
      return false;
    }

    /**
     * 商品添加和显示
     */
    public function articleAddAction(){
      $this->getView()->assign('cur','articleList');
      $this->getView()->assign('here','文章编辑');
      if(IS_POST){
        $data = array(
            'id'  => safe::filterPost('id','int',0),
            'title'  => safe::filterPost('title'),
            'cat_id'=> safe::filterPost('cat_id','int'),
            'description' => safe::filterPost('description'),
            'showindex' => safe::filterPost('index'),
            'content'     => $_POST['content'],
            'status'      => safe::filterPost('status','int'),
            'sort'        => safe::filterPost('sort','int'),
            'add_time'    => \Library\time::getDateTime()
        );
        $imgData = safe::filterPost('imgData');

        $obj = new \nainai\article();
        $res = $obj->updateArticle($data,$imgData);
        die(json::encode($res));

      }
      else{

          //上传图片插件
          $plupload = new \Library\plupload(\Library\url::createUrl('admin/article/upload'));

          //注意，js要放到html的最后面，否则会无效
          $this->getView()->assign('plupload',$plupload->show());
        $model = new \nainai\artCategory();
        $cateList = $model->getCateTree(1);

        $id = $this->getRequest()->getParam('id');
        $id = safe::filter($id,'int',0);
        if($id>0){
            $productObj = new \nainai\article();
            $product = $productObj->get($id);
            $product['content'] = safe::stripSlash($product['content']);

            //获取图片数据
            $product['images'] = $productObj->getArticleImages($id);
            $this->getView()->assign('article',$product);
        }


        $this->getView()->assign('list',$cateList);
      }

    }

    public function articleListAction(){
        $this->getView()->assign('cur','articleList');
        $this->getView()->assign('here','文章列表');
        //获取分类
        $model = new \nainai\artCategory();
        $cateList = $model->getCateTree(1);


        $search = array('cat_id'=>0,'keyword'=>'');
        if(IS_POST){
            $search = array(
                'cat_id'=> safe::filterPost('cat_id','int',0),
                'keyword'=> safe::filterPost('keyword')
            );
        }
        else{
            $page = safe::filterGet('page','int',1);
        }

        $proModel = new \nainai\article();
        $article_list = $proModel->getList($page,$search);

        $this->getView()->assign('search',$search);
        $this->getView()->assign('cateList',$cateList);
        $this->getView()->assign('article_list',$article_list['data']);
        $this->getView()->assign('bar',$article_list['bar']);
    }

    public function articleDelAction(){
        if(IS_POST){
            $id = $this->getRequest()->getParam('id');
            if(intval($id)>0){
                $m = new \nainai\article();
                die(json::encode($m->delete($id)));
            }
        }

    }



}