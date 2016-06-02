<?php
/**
 * 模块中控制器基类，init函数用户设置模板目录
 * author:weipinglee
 * Date: 2016/5/24
 * Time: 20:32
 */
use Library\tool;
use Library\client;
class initController extends Yaf\Controller_Abstract{

    public function init(){
        $this->getView()->setLayout('layout');
        $config = new configModel();
        $logo = $config->getConfig('site_logo');
        $phone = $config->getConfig('tel');
        $this->getView()->assign('logo',$logo);
        $this->getView()->assign('tel',$phone);

    }
}