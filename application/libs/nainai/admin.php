<?php
/**
 * ����Ա������
 * User: weipinglee
 * Date: 2016/5/26
 * Time: 21:22
 */

class admin{

    //Ψһ�ֶ�
    protected $uniqueFields = array(
        'username'=>'�û���',
        'mobile'=>'�ֻ���'
    );
    public $rules = array(
        array('id','number','id����',0,'regex'),
        array('user_name','/^[a-zA-Z0-9_]{3,30}$/','�û�����ʽ����'),
        array('password','/^\S{6,15}$/','�����ʽ����',0,'regex',3),

    );
}