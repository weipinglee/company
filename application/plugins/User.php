<?php
class UserPlugin extends Yaf\Plugin_Abstract{
	public function routerStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {

	}

	public function routerShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		//设置视图类的模块和控制器
		$moduleName = $request->getModuleName();
		$controllerName = $request->getControllerName();
		$witty = new \Library\views\witty();
		$witty->setRouter($moduleName,$controllerName);


	}

	public function dispatchLoopStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {

	}

	public function preDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {

	}

	public function postDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		$controllerName = $request->getControllerName();
		echo $controllerName;
	}

	public function dispatchLoopShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {

	}
}
