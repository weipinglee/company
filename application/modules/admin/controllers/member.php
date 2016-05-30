<?php
/**
 * 系统配置
 * User: weipinglee
 * Date: 2016/5/27
 * Time: 20:50
 */
use \Library\safe;
use \Library\json;

class memberController extends baseController{

    public function memberListAction(){
        $this->getView()->assign('cur','memberList');
        $this->getView()->assign('here','会员列表');
        $page = safe::filterGet('page','int',1);
        $obj = new \nainai\member();
        $memberList = $obj->getList($page);

        $this->getView()->assign('list',$memberList['data']);
        $this->getView()->assign('bar',$memberList['bar']);
    }

    public function memberAddAction(){
        $this->getView()->assign('cur','memberAdd');
        $this->getView()->assign('here','会员添加');
        if(IS_POST){
            $data = array(
                'id'  => safe::filterPost('id','int',0),
                'no'  => safe::filterPost('no'),
                'name'  => safe::filterPost('name'),
                'identify_no' => safe::filterPost('identify_no'),
                'create_time'  => safe::filterPost('create_time'),
                'create_person' => safe::filterPost('create_person'),
            );

            $obj = new \nainai\member();
            $res = $obj->update($data);
            die(json::encode($res));

        }
        else{
            $id = $this->getRequest()->getParam('id');
            $id = safe::filter($id,'int',0);
            if($id>0){
                $productObj = new \nainai\member();
                $product = $productObj->get($id);
                $this->getView()->assign('member',$product);
            }

        }

    }

    public function memberDelAction(){
        if(IS_POST){
            $id = $this->getRequest()->getParam('id');
            if(intval($id)>0){
                $m = new \nainai\member();
                die(json::encode($m->delete($id)));
            }
        }

    }

    /**
     * 导入会员
     */
    public function memberExcelAction(){
        if(IS_POST){
            $member = new \nainai\member();
            $res = $member->excelAdd();

            $this->redirect(\Library\url::createUrl('admin/system/message?success='.$res['success'].'&info='.$res['info']));

            return false;
        }




    }








}