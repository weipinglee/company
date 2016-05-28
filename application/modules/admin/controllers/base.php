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
       }

        $this->getView()->assign('username',$this->admin_name);
        //��ȡ���԰�
//        $lang = new \languages\lang();
//        $controllName = strtolower($this->getRequest()->getControllerName()) ;
//       $this->language = $lang->getLangData($this->getModuleName(),$controllName);
//        $this->getView()->assign('lang',$this->language);

        //��ȡ���˵�
        $m = new M('nav_back');
        $nav = $m->where(array('status'=>1))->select();

        $leftNav = array();
        foreach($nav as $key=>$val){
            if($val['link']!='')
                $nav[$key]['link'] = url::createUrl($val['link']);
            $leftNav[$val['block']][] = $nav[$key];
        }
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