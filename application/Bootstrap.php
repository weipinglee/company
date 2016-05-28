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

	protected $config;
	/**
	 * 把配置存到注册表
	 */
	function _initConfig(Yaf\Dispatcher $dispatcher) {
		$this->config = Yaf\Application::app()->getConfig();
		session_start();
		Yaf\Registry::set("config",  $this->config);

		define('REQUEST_METHOD', strtoupper($dispatcher->getRequest()->getMethod()));
		define('IS_GET',        REQUEST_METHOD =='GET' ? true : false);
		define('IS_POST',       REQUEST_METHOD =='POST' ? true : false);
		define('IS_PUT',        REQUEST_METHOD =='PUT' ? true : false);
		define('IS_DELETE',     REQUEST_METHOD =='DELETE' ? true : false);
		define('IS_AJAX',       ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) ? true : false);

	}

	public function _initError(Yaf\Dispatcher $dispatcher) {
		if ($this->config->application->debug)
		{
			define('DEBUG_MODE', false);
			ini_set('display_errors', 'On');
		}
		else
		{
			define('DEBUG_MODE', false);
			ini_set('display_errors', 'Off');
		}
	}

	/**
	 * 注册一个插件
	 */
	public function _initPlugin(Yaf\Dispatcher $dispatcher) {
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

	public function _initView(Yaf\Dispatcher $dispatcher){
		$view = new \Library\views\wittyAdapter(\Yaf\Registry::get("config")->witty->toArray());
		$dispatcher->setView($view);

	}
}
