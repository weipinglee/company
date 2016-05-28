<?php
/**
 * 系统配置
 * User: weipinglee
 * Date: 2016/5/27
 * Time: 20:50
 */
use \Library\safe;
use \Library\json;

class systemController extends baseController{

    /**
     * 配置列表
     */
    public function configListAction(){
        $M = new configModel();
        $configList = $M->getconfigList();

        $this->getView()->assign('config',$configList);

    }

    /**
     * 配置更新操作
     */
    public function configUpdateAction(){
        if(IS_POST){
            $type = safe::filterPost('tab');
            $data = $_POST;
            unset($data[$type]);
            foreach($data as $key=>$v){
                $data[$key] = safe::filter($v);
            }
            $model = new configModel();
            $res = $model->configUpdate($data,$type);
            die(json::encode($res));
        }

    }
}