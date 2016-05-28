<?php
/**
 * 系统配置
 * User: weipinglee
 * Date: 2016/5/27
 * Time: 20:50
 */
use \Library\safe;
use \Library\json;

class productController extends baseController{

  public function cateListAction(){
    $this->getView()->assign('cur','productCat');
    $this->getView()->assign('here','分类列表');
    $model = new \nainai\proCategory();
    $cateList = $model->getCateTree(1);

    $this->getView()->assign('list',$cateList);
  }

    public function cateAddAction(){
      $this->getView()->assign('cur','productCat');
      $this->getView()->assign('here','编辑分类');
      $model = new \nainai\proCategory();
      if(IS_POST){
        $data = array(
            'cat_id'=> safe::filterPost('id','int',0),
            'cate_name'=> safe::filterPost('cate_name'),
            'description'=> safe::filterPost('description'),
            'parent_id' => safe::filterPost('parent_id'),
            'status'    => safe::filterPost('status','int',0),
            'sort'     => safe::filterPost('sort','int')
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
          $model = new \nainai\proCategory();
          $res = $model->delete($id);
          die(json::encode($res));

        }
      }
      return false;
    }

    public function productAddAction(){
      $this->getView()->assign('cur','productList');
      $this->getView()->assign('here','商品列表');
      if(IS_POST){
        $data = array(
            'id'  => safe::filterPost('id','int',0),
            'name'  => safe::filterPost('name'),
            'price' => safe::filterPost('price'),
            'unit'  => safe::filterPost('unit'),
            'cat_id'=> safe::filterPost('cat_id','int'),
            'description' => safe::filterPost('description'),
            'content'     => safe::filterPost('content'),
            'status'      => safe::filterPost('status','int'),
            'sort'        => safe::filterPost('sort','int'),
        );

        $obj = new \nainai\product();
        $res = $obj->update($data);
        die(json::encode($res));

      }
      else{

        $model = new \nainai\proCategory();
        $cateList = $model->getCateTree(1);

        $id = $this->getRequest()->getParam('id');
        $id = safe::filter($id,'int',0);
        if($id>0){
            $productObj = new \nainai\product();
            $product = $productObj->get($id);
            $this->getView()->assign('product',$product);
        }


        $this->getView()->assign('list',$cateList);
      }

    }

    

}