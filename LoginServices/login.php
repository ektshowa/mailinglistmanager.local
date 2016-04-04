<?php

namespace LoginServices;

use AbstractLoginServices\AbstractLogin;

class Login extends AbstractLogin {
	protected $controllerData;
	protected $action;
	protected $credentials;
	
	public function __contructor() {
		//$this->controllerData = $controllerData;
		//$this->action = $action;
		//$this->credentials = $credentials;
	}
	
	// With Login credentials call the controller->action in this function
	public function doLogin(array $controllerData, $action, array $credentials) {
		trigger_error("IN LOGINSERVICES " . $action);	
		error_log(print_r($credentials, TRUE));
			
		require_once $controllerData['folderID'] . $controllerData['filenameID'];
		
		$controllerName = $controllerData['name'];
		
		// $credentials are username and password keys
		$controller = new $controllerName($credentials);
		//--------------------------
		$action = "loginSubscriber";
		//--------------------------
		$result = $controller->$action();
		
		trigger_error("OUT OF LOGIN SERVICE");
		error_log($result);
	}
	
}
