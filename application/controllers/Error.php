<?php
class ErrorController extends yaf\controller_abstract {
	public function errorAction($exception) {
		$this->getView()->assign("exception", $exception);
	}

}
