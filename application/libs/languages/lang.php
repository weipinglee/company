<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/5/27
 * Time: 21:24
 */
namespace languages;
use \Library\session;
use \Library\tool;
class lang {


    protected $langType = 'zh_cn';
    /**
     * 获取当前语言类型
     */
    public function getLangage(){
        $langType = session::get('langage');
        if($langType==null || $langType=='zh'){
            $langType = 'zh_cn';
        }
        else{
            $langType = 'en_us';
        }
        return $langType;
    }
    public function getLangData($moduleName='index' , $controllerName){
        $_LANG= array();
        $this->langType = $this->getLangage();
        $langPath = $this->langType.'/'.strtolower($moduleName);
        $libraryPath = tool::getConfig(array('application','library'));
        $langPath = $libraryPath.'/languages/'.$langPath;
        if(file_exists($langPath.'/common.lang.php')){

            require $langPath.'/common.lang.php';
        }
        if(file_exists($langPath.'/'.$controllerName.'.lang.php')){
            require $langPath.'/'.$controllerName.'.lang.php';
        }
        return $_LANG;
    }
}