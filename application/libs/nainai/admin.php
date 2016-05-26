<?php
/**
 * 管理员管理类
 * User: weipinglee
 * Date: 2016/5/26
 * Time: 21:22
 */

class admin{

    //唯一字段
    protected $uniqueFields = array(
        'username'=>'用户名',
        'mobile'=>'手机号'
    );
    public $rules = array(
        array('id','number','id错误',0,'regex'),
        array('user_name','/^[a-zA-Z0-9_]{3,30}$/','用户名格式错误'),
        array('password','/^\S{6,15}$/','密码格式错误',0,'regex',3),

    );
}