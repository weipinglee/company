<?php

class IndexController extends initController {

	public function indexAction() {

		$this->getView()->setLayout('layout');
		$this->getView()->assign('name','haha');
		//echo $this->getViewpath();


	}
}
