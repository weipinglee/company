<?php

class productController extends initController{


	public function indexAction(){
		$p = new \nainai\product();
		$data = $p->getProductList();
		$this->getView()->assign('data',$data);
	}

	public function detailAction(){
		$id = $this->getRequest()->getParam('id');
		$id = \Library\safe::filter($id,'int',0);
		if($id>0){
			$productObj = new \nainai\product();
			$product = $productObj->get($id);
			$product['content'] = \Library\safe::stripSlash($product['content']);

			//��ȡͼƬ����
			$product['images'] = $productObj->getProductImages($id);

			$this->getView()->assign('product',$product);
		}
	}


}
