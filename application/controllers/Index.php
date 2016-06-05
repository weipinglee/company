<?php

class IndexController extends initController{


	protected $product_num = 4;
	public function indexAction() {

		$this->getView()->assign('cur','首页');
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
		$this->getView()->assign('cur','企业简介');
		$obj = new \nainai\article();
		$data = $obj->getAboutArticle();
		$this->getView()->assign('about',$data);
	}

	/**
	 * 健康行业
	 */
	public function healthyAction(){
		$this->getView()->assign('cur','健康养生');
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
		$this->getView()->assign('cur','公司动态');
		$obj = new \nainai\article();
		$res = $obj->getDongtaiArticle();

		$this->getView()->assign('data',$res);
	}

	public function contactsAction(){
		$this->getView()->assign('cur','联系方式');
		$obj = new \nainai\article();
		$res = $obj->getContactsArticle();

		$this->getView()->assign('data',$res);
	}

	//获取文章详情
	public function articleAction(){
		$id = \Library\safe::filterGet('id','int',0);
		if($id>0){
			$productObj = new \nainai\article();
			$product = $productObj->get($id);
			$product['content'] = \Library\safe::stripSlash($product['content']);

			//获取图片数据
			$product['images'] = $productObj->getArticleImages($id,400,300);


			//获取同类文章列表
			$list = $productObj->getArticleByCateId($product['cat_id']);

			$this->getView()->assign('list',$list);
			$this->getView()->assign('article',$product);
		}

	}




}
