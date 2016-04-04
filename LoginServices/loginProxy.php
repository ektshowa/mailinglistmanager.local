<?php
namespace LoginServices;

require_once ABSTRACT_LOGIN_SERVICES_FOLDER . "abstractLogin.php";
require_once LOGIN_SERVICES_FOLDER . "login.php";

use AbstractLoginServices\AbstractLogin;
use LoginServices\Login;


class LoginProxy extends AbstractLogin {

    protected $controllerData;
	protected $action;
	protected $requestParams;
	
	public function __constructor() {
		trigger_error("IN LOGIN PROXY SERVICES");
		//trigger_error($controllerData['folderID']);
		
		/*
		$this->controllerData = $control;
				$this->action = $action;
				$this->requestParams = $requestParams;*/
		
		
	}
		
	
	public function doLogin(array $controllerData, $action, array $requestParams) {
			trigger_error("IN LOGIN PROXY SERVICES");
		    error_log(print_r($controllerData, TRUE));
			// Extract the credentials from the request parameters to pass them 
			// separately to the login method
			$credentials = array('username' => $requestParams['email'], 'password' => $requestParams['password']);
			$loginService = new Login();
			
			// Add to this function the login credentials
			$loginService->doLogin($controllerData, $action, $credentials);
		}
	
}
