<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/16 0016
 * Time: 上午 9:28
 */

namespace Library\views;

use \Library\url;
class witty{

    protected static $moduleName = 'index';

    protected static $controllerName = '';


    protected static $clientName = '';

    protected static $config = '';

    /**
     * List of Variables which will be replaced in the
     * template
     *
     * @var array
     */
    protected $_tpl_vars = array();

    protected $_root_dir = '';
    //布局文件夹名称
    protected $layoutName = 'layout';
    //模板目录
    public $_tpl_dir = '';

    protected $_layout_dir = '';

    protected $layout = '';

    //编译目录
    protected $_compile_dir = '';
    //缓存目录
    protected $_cache_dir   = '';

    protected $_tpl_ext = '.tpl';

    //设置模块名和控制器名
    public function setRouter($module,$controller){
        self::$moduleName = strtolower($module);
        self::$controllerName = strtolower($controller);
    }

    public function setClient($c){
        self::$clientName = $c;
    }

    public function setConfig($config){
        self::$config = $config;
    }


    public function setTplDir($dir){
        if ($this->isAbsoluteDir($dir)) {//判断是否是绝对路径
            $this->_tpl_dir = $dir;
        }
    }


    /**
     * 设置布局模板目录
     */
    public function setLayoutDir($dir){
        if ($this->isAbsoluteDir($dir)) {//判断是否是绝对路径
            $this->_layout_dir = $dir;
        }
    }


    public function setLayout($str){
        if(is_string($str))
            $this->layout = $this->_layout_dir.$str;
    }

    /**
     * 设置编译目录
     */
    public function setCompileDir($dir){
        if ($this->isAbsoluteDir($dir)) {//判断是否是绝对路径
            $this->_compile_dir = $dir;
            if(!file_exists($this->_compile_dir) && !mkdir($this->_compile_dir)){
                exit('编译目录不存在');
            }
        }
    }



    /**
     * 设置缓存目录
     */
    public function setCacheDir($dir){
        if ($this->isAbsoluteDir($dir)) {//判断是否是绝对路径
            $this->_cache_dir = $dir;
            if(!file_exists($this->_cache_dir) && !mkdir($this->_cache_dir)){
                exit('缓存目录不存在');
            }
        }
    }

    /**
     * 判断是否是绝对路径
     * @$dir str 路径
     */
    private function isAbsoluteDir($dir){
        if (is_string($dir) && (strpos($dir,':') !==false || strpos($dir,'/') ===0)) {
            return true;
        }
        return false;
    }
    /**
     *设置要分配的变量
     * @param $name
     * @param $value
     */
    public function assign($name,$value){
        $this->_tpl_vars[$name] = $value;
    }


    //获取模板名称
    private function getTemplateName(){
        $template = isset(self::$config[self::$moduleName][self::$clientName]['template']) ? self::$config[self::$moduleName][self::$clientName]['template'] : self::$clientName ;
        return $template;
    }
    /**
     * 获取模板目录
     * @return string
     */
    protected function getTplDir(){
        $config = self::$config;
        $templateName = $this->getTemplateName();
        if(self::$moduleName=='index'){

            $path =  $config['root_dir'].DIRECTORY_SEPARATOR.'views'
                .DIRECTORY_SEPARATOR.$templateName.DIRECTORY_SEPARATOR;
        }
        else{
            $path =  $config['root_dir'].DIRECTORY_SEPARATOR.
                'modules'.DIRECTORY_SEPARATOR.self::$moduleName
                .DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.
                $templateName.DIRECTORY_SEPARATOR;
        }

        if(!file_exists($path) ){
            exit('模板目录不存在');
        }

        return $path;
    }

    /**
     * 获取编译目录
     * @return string
     */
    protected function getCompileDir(){
        $templateName = $this->getTemplateName();
        $compileDir = isset(self::$config['compile_dir']) ? self::$config['compile_dir'] : self::$config['root_dir'].DIRECTORY_SEPARATOR.'runtime';
        $compileDir = $compileDir.DIRECTORY_SEPARATOR.self::$moduleName
                    .DIRECTORY_SEPARATOR.$templateName .DIRECTORY_SEPARATOR
                    .self::$controllerName;

        if(!file_exists($compileDir) && !mkdir($compileDir,'0777',true)){
            exit('编译目录不存在');
        }
        return $compileDir;
    }

    protected function getLayoutDir(){
        return $this->_tpl_dir.'layout'.DIRECTORY_SEPARATOR;
    }
    /**
     * 渲染模板
     * @param $tpl  模板文件
     */
    public function render($tpl){

        //获取模板目录
        $this->_tpl_dir = $this->getTplDir();
        $template = $this->_tpl_dir.$tpl;
        extract($this->_tpl_vars);

        //获取编译目录
        $this->_compile_dir = $this->getCompileDir();
        if (!file_exists($template)) {
            exit('ERROR:模板文件不存在！');
        }
        $parse_file = $this->_compile_dir.'/'.md5($tpl).'.php';

        //获取布局文件
        $layout_file =  $this->getLayoutDir().$this->layout.$this->_tpl_ext;

        if(!file_exists($parse_file) || (filemtime($template) > filemtime($parse_file)) || (file_exists($layout_file) && (filemtime($layout_file) > filemtime($parse_file)))){


            $content = file_get_contents($template);

            //处理layout
            $content = $this->renderLayout($layout_file,$content);

            $content = preg_replace_callback('/{include:([\/a-zA-Z0-9_\.]+)}/',array($this,'includeFile'), $content);

            $content = preg_replace_callback('/{(\/?)(\$|url|root|views|echo|foreach|set|if|elseif|else|while|for|code|areatext|area)\s*(:?)([^}]*)}/i', array($this,'translate'), $content);

            if (!file_put_contents($parse_file, $content) ) {
                exit('编译文件生成出错！');
            }
        }
        include($parse_file);
    }

    /**
     * 载入include标签的内容
     * @param $matches
     * @return string
     */
    private function includeFile($matches){
        return file_get_contents($this->_tpl_dir.$matches[1]);
    }
    /**
     * @brief 渲染layout
     * @param string $layoutFile 布局视图文件名
     * @param string $viewContent 视图代码块
     * @return string 编译合成后的完整视图
     */
    private function renderLayout($layoutFile,$viewContent)
    {
        if(is_file($layoutFile))
        {
            //在layout中替换view
            $layoutContent = file_get_contents($layoutFile);
            $content = str_replace('{content}',$viewContent,$layoutContent);

            return $content;
        }
        else
            return $viewContent;
    }

    /**
     * 解析模板标签
     * @param $matches
     * @return string
     */
    private function translate($matches){
        if($matches[1]!=='/')
        {
            switch($matches[2].$matches[3])
            {

                case '$':
                {
                    $str = trim($matches[4]);
                    $first = $str[0];
                    if($first != '.' && $first != '(')//排除js代码
                    {
                        if(strpos($str,')')===false)return '<?php echo isset($'.$str.')?$'.$str.':"";?>';
                        else return '<?php echo $'.$str.';?>';
                    }
                    else return $matches[0];
                }
                case 'echo:': return '<?php echo '.rtrim($matches[4],';/').';?>';

               case 'if:': return '<?php if('.$matches[4].'){?>';
                case 'elseif:': return '<?php }elseif('.$matches[4].'){?>';
                case 'else:': return '<?php }else{'.$matches[4].'?>';
                case 'set:':
                {
                    return '<?php '.$matches[4].'; ?>';
                }
                case 'while:': return '<?php while('.$matches[4].'){?>';
                case 'foreach:':
                {
                    $attr = $this->getAttrs($matches[4]);
                    if(!isset($attr['items'])) $attr['items'] = '$items';
                    if(!isset($attr['key'])) $attr['key'] = '$key';
                    if(!isset($attr['item'])) $attr['item'] = '$item';

                    return '<?php foreach('.$attr['items'].' as '.$attr['key'].' => '.$attr['item'].'){?>';
                }
                case 'for:':
                {
                    $attr = $this->getAttrs($matches[4]);
                    if(!isset($attr['item'])) $attr['item'] = '$i';
                    if(!isset($attr['from'])) $attr['from'] = 0;

                    if(!isset($attr['upto']) && !isset($attr['downto'])) $attr['upto'] = 10;
                    if(isset($attr['upto']))
                    {
                        $op = '<=';
                        $end = $attr['upto'];
                        if($attr['upto']<$attr['from']) $attr['upto'] = $attr['from'];
                        if(!isset($attr['step'])) $attr['step'] = 1;
                    }
                    else
                    {
                        $op = '>=';
                        $end = $attr['downto'];
                        if($attr['downto']>$attr['from'])$attr['downto'] = $attr['from'];
                        if(!isset($attr['step'])) $attr['step'] = -1;
                    }
                    return '<?php for('.$attr['item'].' = '.$attr['from'].' ; '.$attr['item'].$op.$end.' ; '.$attr['item'].' = '.$attr['item'].'+'.$attr['step'].'){?>';
                }

                case 'url:' : {//解析url到编译文件中，后续再访问无需再次解析
                    return url::createUrl(trim($matches[4]));
                }

                case 'views:' : {//模板目录
                    return url::getViewDir().trim(trim($matches[4]),'/');
                }
                break;
                case 'root:' : {//根目录
                    return url::getHost().url::getScriptDir().'/'.trim(trim($matches[4]),'/');
                }
                break;
                case 'area:' : {
                    $attr = $this->getAttrs($matches[4]);
                    if(!isset($attr['data'])) $attr['data'] = '000000';
                     if(!isset($attr['provinceID'])) $attr['provinceID'] = 'seachprov';
                    if(!isset($attr['cityID']))$attr['cityID'] = 'seachcity';
                    if(!isset($attr['districtID']))$attr['districtID'] = 'seachdistrict';
                    if(!isset($attr['inputName'])) $attr['inputName'] = 'area';
                    if(substr($attr['data'],0,1) == '$')
                        $attr['data'] = '<?php echo '.$attr['data'].' ; ?>';

            return   <<< OEF
                <script type="text/javascript">
                 {$attr['inputName']}Obj = new Area();

                  $(function () {
                     {$attr['inputName']}Obj.initComplexArea('{$attr['provinceID']}', '{$attr['cityID']}', '{$attr['districtID']}', '{$attr['data']}','{$attr['inputName']}');
                  });
                </script>
			 <select  id="{$attr['provinceID']}"  onchange=" {$attr['inputName']}Obj.changeComplexProvince(this.value, '{$attr['cityID']}', '{$attr['districtID']}');">
              </select>&nbsp;&nbsp;
              <select  id="{$attr['cityID']}"  onchange=" {$attr['inputName']}Obj.changeCity(this.value,'{$attr['districtID']}','{$attr['districtID']}');">
              </select>&nbsp;&nbsp;<span id='{$attr['districtID']}_div' >
               <select   id="{$attr['districtID']}"  onchange=" {$attr['inputName']}Obj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden"  name="{$attr['inputName']}" {$attr['pattern']} alt="{$attr['alt']}" value='{$attr['data']}' />
                <span></span>
OEF;
                }
                break;

                case 'areatext:' : {
                    $attr = $this->getAttrs($matches[4]);
                    if(!isset($attr['data'])) $attr['data'] = '000000';
                    if(!isset($attr['id'])) $attr['id'] = 'areaText';
                    if(!isset($attr['delimiter'])) $attr['delimiter'] = ' ';
                    if(substr($attr['data'],0,1) == '$')
                        $attr['data'] = '<?php echo '.$attr['data'].' ; ?>';
                    return   <<< OEF
                <script type="text/javascript">
                 {$attr['id']}Obj = new Area();

                  $(function () {
                    var text = {$attr['id']}Obj.getAreaText('{$attr['data']}','{$attr['delimiter']}');
                    $('#{$attr['id']}').html(text);
                  });
                </script>

OEF;

                }
                break;


                default:
                {
                    return $matches[0];
                }
            }
        }
        else
        {
            if($matches[2] =='code') return '?>';
            else return '<?php }?>';
        }
    }

    /**
     * @brief 分析标签属性
     * @param string $str
     * @return array以数组的形式返回属性值
     */
    private function getAttrs($str)
    {
        preg_match_all('/\w+\s*=(?:[^=]+?)(?=(\S+\s*=)|$)/i', trim($str), $attrs);
        $attr = array();
        foreach($attrs[0] as $value)
        {
            $tem = explode('=',$value);
            $attr[trim($tem[0])] = trim($tem[1]);
        }
        return $attr;
    }

    /**
     * @brief 变量替换操作
     * @param string $str
     * @return string
     */
    protected function varReplace($str)
    {
        return preg_replace(array("#(\\$.*?(?=$|\/))#","#(\\$\w+)\[(\w+)\]#"),array("\".$1.\"","$1['$2']"),$str);
    }

}