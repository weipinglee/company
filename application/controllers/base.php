<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/5/27
 * Time: 20:51
 */
use \Library\M;
use \Library\url;
use \Library\photoupload;
class baseController extends Yaf\Controller_Abstract{

    public $language = array();


    public function init(){
        $this->getView()->setLayout('layout');

        //�����Ƿ��¼
       $right = new \Library\checkRight();

       if(!$right->checkLogin($this)){//δ��¼��ת����½ҳ��
          $this->redirect(url::createUrl('admin/login/login'));
          exit;
       }

        $this->getView()->assign('username',$this->admin_name);

        $leftNav = array();
        //�����Ƿ�����ӦȨ��
        $manager = new \nainai\manager();
        $access= $manager->checkAccess($this->admin_name,
            $this->getRequest()->getControllerName(),$leftNav);
        if(!$access){
            $this->redirect(url::createUrl('admin/index/index'));
            exit;
        }



        //��ȡ���԰�
//        $lang = new \languages\lang();
//        $controllName = strtolower($this->getRequest()->getControllerName()) ;
//       $this->language = $lang->getLangData($this->getModuleName(),$controllName);
//        $this->getView()->assign('lang',$this->language);


        $this->getView()->assign('nav',$leftNav);


    }


    /**
     * ajax�ϴ�ͼƬ
     * @return bool
     */
    public function uploadAction(){
        //�����ļ��ϴ���
        $photoObj = new photoupload();
        $photoObj->setThumbParams(array(180,180));
        $photo = current($photoObj->uploadPhoto());

        if($photo['flag'] == 1)
        {
            $result = array(
                'flag'=> 1,
                'img' => $photo['img'],
                'thumb'=> $photo['thumb'][1]
            );
        }
        else
        {
            $result = array('flag'=> $photo['flag'],'error'=>$photo['errInfo']);
        }
        echo \Library\json::encode($result);

        return false;
    }
}