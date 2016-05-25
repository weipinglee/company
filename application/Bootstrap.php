<?php
/**
 * Bootstrap类, 在这个类中, 所以以_init开头的方法
 * 都会被调用, 调用次序和申明次序相同
 * 
 * @author  Laruence
 * @date    2011-05-13 15:24
 * @version $Id$ 
*/

class Bootstrap extends Yaf\Bootstrap_Abstract {
	/**
	 * 把配置存到注册表
	 */
	function _initConfig(Yaf\Dispatcher $dispatcher) {
		$config = Yaf\Application::app()->getConfig();

		Yaf\Registry::set("config",  $config);
	}



	/**
	 * 注册一个插件
	 */
	function _initPlugin(Yaf\Dispatcher $dispatcher) {
		$user = new UserPlugin();
		$dispatcher->registerPlugin($user);
	}


	public function _initRoute(Yaf\Dispatcher $dispatcher) {
	//注册路由
	$router = Yaf\Dispatcher::getInstance()->getRouter();
	$config_routes = Yaf\Registry::get("config")->routes;
	if(!empty($config_routes))
		$router->addConfig(Yaf\Registry::get("config")->routes);
	}
}
