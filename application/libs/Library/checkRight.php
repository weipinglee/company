<?php
/**
 * 登录管理类
 * User: weipinglee
 * Date: 2016/3/1 0001
 * Time: 下午 3:08
 */
namespace Library;
use \Library\Session\Driver\Db;
use \Library\url;
class checkRight{


    /**
     * @var string 用户的数据表名
     */
    protected $userTable = 'admin';

    protected $loginSessName = 'login';

    protected $pk = 'id';//用户表主键
    /**
     * session存放方式,simple方式表示session不存入任何地方
     * @var string
     */
    protected $sessType = 'simple';
    /**
     * 计入session的字段，键为生成session的名称
     * @var array
     */
    protected $loginSessFields = array(
        'admin_id'=>'id',
        'admin_name'=>'user_name',
        'admin_email'=>'email'
    );

    //登录用到的字段
    protected $loginTableFields = array(
        'userinfo'=> array('user_name'),//可以用户登录的字段
        'password'=>'password'//密码字段名
    );

    //登录地址
    protected $loginUrl = 'admin/login/login';


    protected $passwordType = 'md5';//密码加密方式
    //session操作对象
    static private $sessObj = null;
    /**
     *
     */
    public function __construct(){
        $this->sessType = 'simple';//根据配置文件获取
        $expireTime = 7200;
        switch($this->sessType){
            case 'DB' : {
                $tableName = 'user_session';
                self::$sessObj = new Db($tableName,$expireTime);
            }
            break;
            case 'simple' :
            default:{
                self::$sessObj = null;//session不写入数据库或缓存
            }
        }
    }

    /**
     * 判断用户名密码是否正确
     * @param $data
     */
    public function checkUserRight($data){
        $obj = new M($this->userTable);
        $passField = $this->loginTableFields['password'];
        foreach($this->loginTableFields['userinfo'] as $f){
            $res = $obj->where(array($f=>$data[$f],$passField=>call_user_func($this->passwordType,$data[$passField])))->getObj();
            if(!empty($res)){
                $this->loginAfter($res);
                return true;
            }
        }
        return false;
    }

    /**
     * 获取session中记录用户id的键值
     * @return mixed
     */
    protected function getSessPk(){
        $idName = array_keys($this->loginSessFields);
        return $idName[0];
    }

    /**
     * 登录后处理
     * @param array $data  用户登录数据
     */
    public function loginAfter($data){
        //设置session
        $sessName = $this->loginSessName;
        session_regenerate_id(true);
        session::clear($sessName);
        foreach($this->loginSessFields as $k=>$f){
            session::merge($sessName,array($k=>$data[$f]));
        }

        //session数据计入数据库
        if(self::$sessObj!=null){

            $sessID = session_id();
            $sessData = session::get($this->loginSessName);
            self::$sessObj->gc();
            self::$sessObj->write($sessID,serialize($sessData));

            $userModel = new M($this->userTable);
            $userModel->where(array($this->pk=>$data[$this->pk]))->data(array('session_id'=>$sessID))->update();

        }

    }


    /**
     *验证是否登录:判断已登录条件：存在session['login']、session中user_id的用户session_id字段等于session_id()、session_id()未过期
     * @param object $obj 控制器实例
     * @return bool 是否登录
     */
    public function checkLogin($obj=null){
        $sessID = session_id();
        $sessLogin = session::get($this->loginSessName);
        $isLogin = false;

        //判断是否登录以及登录是否超时
        $idName = $this->getSessPk();
        if($sessLogin!=null && isset($sessLogin[$idName]) && $sessID !=''){

            if(self::$sessObj==null){
                $isLogin = true;
            }
            else{
                $userModel = new M($this->userTable);
                $login_sess = $userModel->where(array($this->pk=>$sessLogin[$idName]))->fields('session_id')->getObj();

                if($sessID == $login_sess['session_id'] && self::$sessObj->expire($sessID)){
                    $isLogin = true;

                }
            }


        }
        if($obj!==null && $isLogin ==true){
                foreach($sessLogin as $k=>$v){
                    $obj->$k = $v;
                }

        }
        return $isLogin;
    }

    

    /**
     * 登出
     */
    public function logOut(){
        $sessID = session_id();
        $sessLogin = session::get($this->loginSessName);
        session::clear($this->loginSessName);
        if(self::$sessObj!=null){
            $idName = $this->getSessPk();
            if(isset($sessLogin[$idName])){
                $userModel = new M($this->userTable);
                $userModel->where(array($this->pk=>$sessLogin[$idName]))->data(array('session_id'=>''))->update();
            }

            self::$sessObj->destroy($sessID);
        }






    }

}