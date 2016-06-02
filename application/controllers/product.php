<?php

class productController extends initController{


	public function indexAction(){
		$p = new \nainai\product();
		$data = $p->getProductList();
		$this->getView()->assign('data',$data);
	}


}
