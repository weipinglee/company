<?php

class IndexController extends initController{


	public function indexAction() {
		echo 'ddd';


	}

	public function aAction(){
		$a = $this->getRequest()->getParam('d');
		echo $a;
		return false;
	}
}
