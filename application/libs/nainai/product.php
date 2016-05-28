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
class product extends base{

    protected $table = 'product';

    protected $pk = 'id';
    protected $rules = array(
        array('id','number','错误',0,'regex'),
        array('cat_id','number','分类错误',0,'regex'),
        array('price','currency','价格错误',0,'regex'),
        array('unit','s{1,20}','单位错误',0,'regex'),
        array('name','s{2,30}','商品名错误',0,'regex'),
        array('description','s{0,255}','描述错误',0,'regex'),
        array('status','number','格式错误',0,'regex'),
        array('sort','number','格式错误',0,'regex'),
    );





}