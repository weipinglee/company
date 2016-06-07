<?php
/**
 * 登录登出控制器
 * author: weipinglee
 * Date: 2016/5/26
 * Time: 17:49
 */
use \Library\safe;
use \Library\json;
use \Library\tool;
class loginController extends Yaf\Controller_Abstract{

    public function loginAction(){
        $config = new configModel();
        $logo = $config->getConfig('site_logo');
        $logo = \Library\thumb::get($logo,188,66);
        $this->getView()->assign('logo',$logo);
    }

    /**
     * 登录处理
     */
    public function doLoginAction(){
        $userData = array(
            'user_name'=>safe::filterPost('user_name'),
            'password'=> $_POST['password']
        );
        $captcha  = safe::filterPost('captcha','/^[a-zA-Z]{4}$/');
        $captchaObj = new \Library\captcha();
        if($userData['user_name']==''){
            die(json::encode(tool::getSuccInfo(0,'用户名不能为空')));
        }

        if($captcha=='')
            die(json::encode(tool::getSuccInfo(0,'验证码不能为空')));
        if(!$captchaObj->check($captcha)){
            die(json::encode(tool::getSuccInfo(0,'验证码错误')));
        }
        else{
            $check = new \Library\checkRight();
            $res = $check->checkUserRight($userData);
            if($res==true){//登录成功
                $log = new \nainai\log();
                $log->addLogs(array('type'=>'login'));
                die(json::encode(tool::getSuccInfo()));
            }
            else{
                die(json::encode(tool::getSuccInfo(0,'用户名或密码错误')));
            }
        }
    }

    /**
     * 生成验证码
     */
    public function getCaptchaAction(){

        $ca = new \Library\captcha();
        $ca->CreateImage();
    }

    public function logoutAction(){
        $check = new \Library\checkRight();
        $check->logOut();
        $this->redirect(\Library\url::createUrl('admin/login/login'));
        return false;
    }
}