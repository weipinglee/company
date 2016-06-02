<?php

class IndexController extends initController{


	protected $product_num = 4;
	public function indexAction() {

		//��ȡ�õ�
		$show = new \nainai\show();
		$showList = $show->showList();
		$this->getView()->assign('show',$showList);

		//��ȡ��Ʒ��
		$product = new \nainai\product();
		$proList = $product->getProductList($this->product_num);

		$this->getView()->assign('product',$proList);

	}

	/**
	 * ��˾���
	 */
	public function aboutAction(){
		$obj = new \nainai\article();
		$data = $obj->getAboutArticle();
		$this->getView()->assign('about',$data);
	}

	/**
	 * ������ҵ
	 */
	public function healthyAction(){
		$obj = new \nainai\article();
		$data = $obj->getHealthyArticle();
		$res = array();
		foreach($data as $k=>$v){
			$res[] = $v;
		}
		//print_r($res);
		$this->getView()->assign('data',$res);

	}

	public function dongtaiAction(){
		$obj = new \nainai\article();
		$res = $obj->getDongtaiArticle();

		$this->getView()->assign('data',$res);
	}

}
