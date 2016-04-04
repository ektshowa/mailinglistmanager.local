<?php

namespace AbstractLoginServices;

abstract class AbstractLogin {
	
	public function __contructor(array $controllerData, $action, array $credentials) {
		$this->controllerData = $controllerData;
		$this->action = $action;
		$this->credentials = $credentials;
	}
	
	//protected $username, $password, $igor, $goodLog, $badLog;
	//protected $security = array();
	//protected $passSecurity = FALSE;
	//protected abstract function loginOrDie();
	public abstract function doLogin(array $controllerData, $action, array $requestParams);
	
	//protected function setPassword();
}
