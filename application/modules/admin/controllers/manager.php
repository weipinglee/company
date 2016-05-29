<?php
/**
 * 管理员管理
 * User: weipinglee
 * Date: 2016/5/27
 * Time: 20:50
 */
use \Library\safe;
use \Library\json;

class managerController extends baseController{

    public function managerListAction(){
        $this->getView()->assign('cur','adminList');
        $this->getView()->assign('here','管理员列表');
        $page = safe::filterGet('page','int',1);
        $obj = new \nainai\manager();
        $memberList = $obj->getList($page);

        $this->getView()->assign('list',$memberList['data']);
        $this->getView()->assign('bar',$memberList['bar']);
    }

    public function managerAddAction(){
        $this->getView()->assign('cur','adminList');
        $this->getView()->assign('here','管理员添加');
        if(IS_POST){
            $data = array(
                'id'  => safe::filterPost('id','int',0),
                'user_name'  => safe::filterPost('user_name'),
                'email'  => safe::filterPost('email'),
            );
            $pass = safe::filterPost('password');
            if($data['id']==0){//新增记录添加时间
                $data['password']  = $pass;
                $data['add_time'] = \Library\time::getDateTime();
            }

            if($data['id']!=0 && $pass!=''){
                $data['password']  = $pass;
            }

            $obj = new \nainai\manager();
            $res  = $obj->updateManager($data);
            die(json::encode($res));


        }
        else{
            $id = $this->getRequest()->getParam('id');
            $id = safe::filter($id,'int',0);
            if($id>0){
                $productObj = new \nainai\manager();
                $product = $productObj->get($id);

                $this->getView()->assign('manager',$product);
            }

        }

    }

    public function managerDelAction(){
        if(IS_POST){
            $id = $this->getRequest()->getParam('id');
            if(intval($id)>0){
                $m = new \nainai\manager();
                die(json::encode($m->delete($id)));
            }
        }

    }








}