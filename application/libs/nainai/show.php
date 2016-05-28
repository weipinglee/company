<?php
/**
 * 首页幻灯
 * User: weipinglee
 * Date: 2016/5/28
 * Time: 11:23
 */
namespace nainai;
use \Library\M;
use \Library\tool;
use \Library\thumb;
class show extends base{

    protected $table = 'show';

    protected $rules = array(
        array('id','number','错误',0,'regex'),
        array('show_name','s{2,30}','幻灯名格式错误',0,'regex'),
        array('show_link','url','导航链接错误',0,'regex'),
        array('show_img','/^[a-zA-Z0-9_@\.\/]+$/','图片格式错误',0,'regex'),
        array('type',array('mobile','pc'),'类型格式错误',0,'in'),
        array('sort','number','格式错误',0,'regex'),
    );

    public function showList(){
        $obj = new M('show');
        $data = $obj->select();
        foreach($data as $k=>$v){
            $data[$k]['show_img'] = thumb::get($data[$k]['show_img'],150,150);
        }
        return $data;
    }

}