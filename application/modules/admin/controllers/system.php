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

        $this->getView()->assign('cur','system');
        $this->getView()->assign('here','系统配置');
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

    /**
     * 导航列表
     */
    public function navListAction(){
        $this->getView()->assign('cur','nav');
        $this->getView()->assign('here','导航列表');

        $guide = new \nainai\guide();
        $type = $guide->checkType(safe::filterGet('type'));

        $this->getView()->assign('type',$type);
        $navList  = $guide->getNavList($type);

        foreach($navList as $k=>$v){
            if($v['level']!=0){
                $navList[$k]['nav_name'] = str_repeat('--',$v['level']).$navList[$k]['nav_name'];
            }

            //获取链接
            if($v['module']!=''){
                $navList[$k]['link'] = \Library\url::createUrl($v['module']);
            }
            else
                $navList[$k]['link'] = $navList[$k]['guide'];
        }
        $this->getView()->assign('list',$navList);

    }

    /**
     * 导航添加
     */
    public function navAddAction(){
        $this->getView()->assign('cur','nav');
        $this->getView()->assign('here','添加导航');
        $guide = new \nainai\guide();
        $middle = $guide->getNavList('middle');

        $this->getView()->assign('parent',$middle);

    }

    public function doNavAddAction(){
        if(IS_POST){
            $data = array(
                //'id'    => safe::filterPost('id','int',0),
                'module'=>safe::filterPost('nav_menu','string',''),
                'nav_name' => safe::filterPost('nav_name'),
                'guide' => safe::filterPost('guide'),
                'type'  => safe::filterPost('type'),
                'parent_id' => safe::filterPost('parent_id','int',0),
                'sort'  => safe::filterPost('sort','int')

            );

            $guide = new \nainai\guide();
            $res = $guide->add($data);
            die(json::encode($res));

        }
    }

    /**
     * ajax获取不同类型的分类
     * @return bool
     */
    public function ajaxGetNavAction(){
        if(IS_POST){
            $type = safe::filterPost('type');
            $guide = new \nainai\guide();
            $middle = $guide->getNavList($type);
            foreach($middle as $key=>$val){
                if($val['level']!=0){
                    $middle[$key]['nav_name'] = str_repeat('--',$val['level']).$middle[$key]['nav_name'];
                }
            }
            die(json::encode($middle));
        }
        return false;

    }

    /**
     * 导航编辑
     */
    public function navEditAction(){
        $guide = new \nainai\guide();
        if(IS_POST){
            $data['id'] = safe::filterPost('id','int');
            $data['module'] = safe::filterPost('nav_menu');
            $data['nav_name'] = safe::filterPost('nav_name');
            $data['type'] = safe::filterPost('type');
            $data['parent_id'] = safe::filterPost('parent_id');
            $data['sort'] = safe::filterPost('sort');
            if($data['module']==''){
                $data['guide'] = safe::filterPost('guide');
            }
            $res = $guide->update($data);

            die(json::encode($res));

        }
        else{
            $this->getView()->assign('cur','nav');
            $this->getView()->assign('here','导航编辑');
            $id = $this->getRequest()->getParam('id');
            $id = safe::filter($id,'int',0);
            if($id){
                $navType = $guide::getType();
                $navText = $guide::getTypeText();

                $navDetail = $guide->getNavDetail($id);

                $this->getView()->assign('nav_info',$navDetail);
                $this->getView()->assign('navType',$navType);
                $this->getView()->assign('navText',$navText);
            }
        }
    }

    /**
     * 导航删除
     */
    public function navDelAction(){
        if(IS_POST){
            $id = $this->getRequest()->getParam('id');
            $id = safe::filter($id,'int',0);
            if($id>0){
                $model = new \nainai\guide();
                $res = $model->delete($id);
                die(json::encode($res));
            }
        }
        return false;
    }

    /**
     * 幻灯列表
     */
    public function showListAction(){
        $this->getView()->assign('cur','show');
        $this->getView()->assign('here','幻灯列表');
        $showObj = new \nainai\show();
        $show = $showObj->showList();
        $this->getView()->assign('show',$show);
    }

    /**
     * 幻灯添加
     */
    public function showAddAction(){
        $this->getView()->assign('cur','show');
        $this->getView()->assign('here','幻灯编辑');
        $model = new \nainai\show();
        if(IS_POST){
            $data = array(
                'id'=> safe::filterPost('id','int',0),
                'show_name'=> safe::filterPost('show_name'),
                'show_link'=> safe::filterPost('show_link'),
                'show_img' => safe::filterPost('show_img'),
                'sort'     => safe::filterPost('sort','int')
            );

            $res = $model->update($data);
            die(json::encode($res));

        }
        else{
            $id = $this->getRequest()->getParam('id');
            if(intval($id)>0){
                $res = $model->get($id);
                $res['thumb'] = \Library\thumb::get($res['show_img']);
                $this->getView()->assign('show',$res);
            }

        }
    }

    public function showDelAction(){
        if(IS_POST){
            $id = $this->getRequest()->getParam('id');
            $id = safe::filter($id,'int',0);
            if($id>0){
                $model = new \nainai\show();
                $res = $model->delete($id);
                die(json::encode($res));
            }
        }
        return false;
    }
}