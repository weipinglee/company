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

		//获取首页显示的文章
		$article = new \nainai\article();
		$articleList = $article->getIndexArticle();


		$this->getView()->assign('article',$articleList);
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


	/**
	 * 公司动态
	 */
	public function blogAction(){
		$obj = new \nainai\article();
		$res = $obj->getDongtaiArticle();

		$this->getView()->assign('data',$res);
	}

	public function contactsAction(){
		$obj = new \nainai\article();
		$res = $obj->getContactsArticle();

		$this->getView()->assign('data',$res);
	}



}
