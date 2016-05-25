<?php

class IndexController extends Yaf\Controller_Abstract {
	public function init() {

	}

	public function indexAction() {
		print_r($_GET);return false;
	}

	public function aAction(){
		$a = $this->getRequest()->getParam('d');
		echo $a;
		return false;
	}
}
