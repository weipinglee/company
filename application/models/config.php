<?php
/**
 * 配置管理
 * User: weipinglee
 * Date: 2016/5/28
 * Time: 11:23
 */
use \Library\M;
use \Library\tool;
use \Library\thumb;
class configModel{

    protected $configType = array('main','mail','mobile');
    protected $table = 'config';
    protected $rules = array(
        array('name','/^[a-zA-Z_]{2,30}$/','配置名错误',0,'regex'),
        array('value','/^[\S]{1,255}$/u','配置信息错误',0,'regex')
    );
    public function getconfigList(){
        $configObj = new M('config');
        $config = $configObj->where(array('status'=>1))->select();
        foreach($config as $key=>$val){
            if($val['type']=='file'){
                $config[$key]['thumb'] = thumb::get($val['value'],180,180);
            }
        }
        $configList = array();
        foreach($config as $k=>$c){
            $configList[$c['tab']][] = $c;
        }
        return $configList;
    }

    public function configUpdate($config,$type){
        $m = new M('config');
        if($type=='' || in_array($type,$this->configType)){
            $m->beginTrans();
            foreach($config as $key=>$val){
                $m->where(array('tab'=>$type,'name'=>$key))->data(array('value'=>$val))->update();
            }
           $res = $m->commit();
            if($res===true){
                return tool::getSuccInfo();
            }
            else{
                return tool::getSuccInfo(0,'操作失败');
            }
        }
        else return tool::getSuccInfo(0,'参数错误');
    }
}