<?php
/**
 * 商品分类
 * User: weipinglee
 * Date: 2016/5/28
 * Time: 11:23
 */
namespace nainai;
use \Library\M;
use \Library\tool;
use \Library\thumb;
use \Library\Query;
class manager extends base{

    protected $table = 'admin';

    protected $logTable = 'admin_log';

    protected $uniqueFields = array('user_name');
    protected $uniqueFieldsText = array('user_name'=>'管理员用户名');

    protected $pk = 'id';
    protected $rules = array(
        array('id','number','错误',0,'regex'),
        array('user_name','/^[0-9a-zA-Z_]{2,20}$/','用户名错误',0,'regex'),
        array('email','email','邮箱错误',0,'regex'),
        array('password','/^[\S]{6,40}$/','密码错误',0,'regex'),
        array('add_time','datetime','时间错误',0,'regex'),
        array('action_list','/^[a-zA-Z,]{2,}$/'),
        array('last_login','datetime','时间错误',0,'regex'),
        array('last_id','/^[\d]{3}\.[\d]{3}\.[\d]{3}\.[\d]{3}$/','ip错误',0,'regex'),
    );

    /**
     * 管理员权限列表，控制器名
     * @var array
     */
    public function getAccessList(){
        return array(
            'system'  =>'系统管理',
            'product' => '商品管理',
            'article' => '文章管理',
            'manager' => '管理员管理',
            'member'  => "会员管理"
        );
    }



    /**
     * 获取产品列表
     * @param int $page 页码
     * @return array
     */
    public function getList($page){
        $Q = new Query($this->table);
        $Q->page = $page;
        $Q->pagesize = 20;
        $data = $Q->find();
        $pageBar =  $Q->getPageBar();


        return array('data'=>$data,'bar'=>$pageBar);
    }

    /**
     * 判断唯一字段是否已注册
     * @param $data
     */
    public function checkExist($data){

        $keys = array_keys($data);
        $where = array();
        if(in_array($this->pk,$keys) && $data[$this->pk]!=0){//数据包含主键
            $where[$this->pk] = array('neq',$data[$this->pk]);
        }
        $obj = new M($this->table);
        foreach($keys as $f){
            if(in_array($f,$this->uniqueFields)){//如果f是唯一字段
                $where[$f] = $data[$f];
                $res = $obj->where($where)->fields($this->pk)->getObj();
                if(!empty($res)){
                    return tool::getSuccInfo(0,$this->uniqueFieldsText[$f].'已存在');
                }
                unset($where[$f]);
            }
        }
        return tool::getSuccInfo();
    }

    public function updateManager($data){
        $check = $this->checkExist($data);
        if($check['success']==1){
            if(isset($data['password']))
                 $data['password'] = md5($data['password']);
            $res = $this->update($data);
            return $res;
        }
        else{
            return$check;
        }
    }

    /**
     * 获取管理员详情
     * @param $id
     * @return mixed
     */
    public function getDetail($id){
        $data = $this->get($id);
        $data['super'] = 0;
        if(!empty($data)){
            if(strtolower($data['action_list'])=='all'){
                $data['super'] = 1;
            }
            else{
                $data['action_list'] = explode(',',$data['action_list']);
            }

        }

        return $data;
    }

    /**
     * 检验权限
     */
    public function checkAccess($user_name,$controller,&$leftNav){
        $controller = strtolower($controller);
        $obj = new M($this->table);
        $access = $obj->where(array('user_name'=>$user_name))->getField('action_list');

        if($access){
            $accessList = explode(',',$access);

            //获取左侧菜单,每个菜单关联控制器，不在权限允许的控制器中则不显示
            $m = new M('nav_back');
            $nav = $m->where(array('status'=>1))->select();
            $leftNav = array();
            foreach($nav as $key=>$val){
                if(strtolower($access)=='all' || in_array($val['controller'],$accessList)){
                    if($val['link']!='')
                        $nav[$key]['link'] = \Library\url::createUrl($val['link']);
                    $leftNav[$val['block']][] = $nav[$key];
                }

            }

            if(strtolower($access)=='all' || in_array($controller,$accessList)){
                return true;
            }
        }
        return false;
    }

    /**
     * 获取操作日志列表
     */
    public function managerLogList($page=1){
        $Q = new Query($this->logTable.' as log');
        $Q->join = 'left join '.$this->table.' as m on log.user_id = m.id';
        $Q->fields = 'log.*,m.user_name';
        $Q->order = 'log.id DESC';
        $Q->page = $page;
        $Q->pagesize = 10;
        $data = $Q->find();
        $pageBar =  $Q->getPageBar();


        return array('data'=>$data,'bar'=>$pageBar);
    }





}