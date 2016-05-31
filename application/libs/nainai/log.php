<?php
/**
 * 管理员管理类
 * User: weipinglee
 * Date: 2016/5/26
 * Time: 21:22
 */
namespace nainai;
class log extends base{


    public $rules = array(
        array('id','number','id错误',0,'regex'),
        array('user_id','number','用户id错误'),
        array('action','/^\S{2,50}$/','',0,'regex'),

    );

    protected $table = 'admin_log';

    protected $logTables = array(
        'admin' => '管理员',
        'article' => '文章',
        'article_category'  => '文章分类',
        'config'  => '配置',
        'member'  => '会员',
        'nav'     => '导航',
        'product' => '产品',
        'product_category' => '产品分类',
        'show'    => '首页幻灯'
    );

    /**
     * 添加管理员日志
     * @param array $log array('table'=>,'type'=>,'id'=>,'count'=>)
     */
    public function addLogs($log){
        $logTableRev = array_flip($this->logTables);
        if($log['type']=='login' || in_array($log['table'],$logTableRev)){
            $log_text = '';
            switch($log['type']){
                case 'login': {
                    $log_text = '登录成功';
                }
                break;
                case 'add' : {
                    $log_text = '添加了'.$this->logTables[$log['table']].',id为'.$log['id'];
                }
                break;
                case 'update' : {
                    $log_text = '更改了id为'.$log['id'].'的'.$this->logTables[$log['table']];

                }
                break;
                case 'delete' : {
                    $log_text = '删除了id为'.$log['id'].'的'.$this->logTables[$log['table']];

                }
                break;
                case 'adds' : {
                    $log_text = '新增了'.$log['count'].'条'.$this->logTables[$log['table']].'数据';
                }
                break;
            }
            $logData = array();
            $logData['action'] = $log_text;

            $right = new \Library\checkRight();
            $logData['user_id'] = $right->getLoginAdminID();
            $logData['create_time'] = \Library\time::getDateTime();
            $logData['ip'] = \Library\client::getIp();

            $this->add($logData);

        }
    }


}