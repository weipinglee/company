<?php

class memberController extends initController{


	public function indexAction(){
		$this->getView()->assign('cur','会员查询');
		$data = array();
		if(IS_POST){
			$name = \Library\safe::filterPost('name');
			if($name!=''){
				$member = new \nainai\member();
				$data = $member->searchMember($name);

				$this->getView()->assign('data',$data);
			}



		}
	}


}
