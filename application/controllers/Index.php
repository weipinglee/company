<?php

class IndexController extends initController{


	protected $product_num = 4;
	public function indexAction() {

		//获取幻灯
		$show = new \nainai\show();
		$showList = $show->showList();
		$this->getView()->assign('show',$showList);

		//获取产品连
		$product = new \nainai\product();
		$proList = $product->getProductList($this->product_num);

		$this->getView()->assign('product',$proList);

	}

	/**
	 * 公司简介
	 */
	public function aboutAction(){
		$obj = new \nainai\article();
		$data = $obj->getAboutArticle();
		$this->getView()->assign('about',$data);
	}

	/**
	 * 健康行业
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
