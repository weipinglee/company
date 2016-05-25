<?php
/**
 * Yaf 入口文件
 * 
 * @author  Laruence
 * @date    2011-05-13 15:00
 * @version $Id$ 
 */
date_default_timezone_set('Asia/Shanghai');

define("APPLICATION_PATH",dirname(__DIR__));

if (!extension_loaded('yaf')) {
        include(APPLICATION_PATH . '/framework/loader.php');
    
}
error_reporting(E_ALL);
$app = new Yaf\Application(APPLICATION_PATH . "/conf/application.ini", 'production');
$app->bootstrap()->run();
