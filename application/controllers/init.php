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

        //获取导航
        $guide = new \nainai\guide();
       $navList =  $guide->getNavList('middle');
        $this->getView()->assign('navlist',$navList);
        $this->getView()->assign('logo',$logo);
        $this->getView()->assign('tel',$phone);

        //获取底部文章列表
        $pro = new \nainai\article();
        $bottomArt = $pro->getBottomarticle();
        $this->getView()->assign('bottom',$bottomArt);

    }
}