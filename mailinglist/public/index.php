<?php

// Define path to data folder
define('DATA_PATH', realpath(dirname(__FILE__).'/data'));

//Define our id-key pairs
$applications = array(
    'APP001' => '28e336ac6c9423d946ba02d19c6a2632', //randomly generated app key 
);

//include our models
//include_once 'Models/subscriber.php';
//include_once 'Helpers/DatabaseConnection.php';
//include_once 'Helpers/DBUtils.php'; 

use Controllers\Subcribers;
 
//wrap the whole thing in a try-catch block to catch any wayward exceptions!
try {
    //get the encrypted request
    $enc_request = $_REQUEST['enc_request'];
	
	//get the provided app id
    $app_id = $_REQUEST['app_id'];
	
	//check first if the app id exists in the list of applications
    //if( !isset($applications[$app_id]) ) {
    //    throw new Exception('Application does not exist!');
    //}
	
	//decrypt the request
    //$params = json_decode(trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $applications[$app_id], base64_decode($enc_request), MCRYPT_MODE_ECB)));
    
	//check if the request is valid by checking if it's an array and looking for the controller and action
    //if( $params == false || isset($params->controller) == false || isset($params->action) == false ) {
    //    throw new Exception('Request is not valid');
    //}
	$params = array(
		'email'	=> 'fistsub@google.com',
		'firstname'	=> 'firstsub',
			'lastname'	=> 'lastsub',
			'password'	=> sha1('admin'),
			'role'		=> 'admin',
			'mimetype'	=> 'H',
			'controller' => 'subscribers',
			'username' => 'admin'
	);
	
	//cast it into an array
    //$params = (array) $params;
	
	$controller = $params['controller'];
	 
	//get the action and format it correctly so all the
    //letters are not capitalized, and append 'Action'
    //$action = strtolower($params['action']).'Action';
    $action = 'createAction';
 
    //check if the controller exists. if not, throw an exception
    //if( file_exists("Controllers/{$controller}.php") ) {
    //    include_once "Controllers/{$controller}.php";
    //} else {
    //    throw new Exception('Controller is invalid.');
    //}
    
    //if( file_exists("Controllers/subscribers.php") ) {
    //    include_once "Controllers/subscribers.php";
    //} else {
    //    throw new Exception('Controller is invalid.');
    //}
    
    if (! file_exists("Controllers/{$controller}.php")) {
    //if (! file_exists("Controllers/subscribers.php")) {
    	throw new Exception('Controller is invalid ');
    }
	else {
		include_once "Controllers/subscribers.php";
		//get the controller and format it correctly so the first
    	//letter is always capitalized
    	$controller = ucfirst(strtolower($params['controller']));
		trigger_error("CONTROLLER VALID");
	}
     
    //create a new instance of the controller, and pass
    //it the parameters from the request
    $controller = "Controllers\{$controller}" ;
    
    //$controller = new $controller($params);
    $controller = new Controllers\Subscribers($params);
     
    //check if the action exists in the controller. if not, throw an exception.
    if( method_exists($controller, $action) === false ) {
        throw new Exception('Action is invalid.');
    }
     
    //execute the action
    //$result['data'] = $controller->$action();
    $result['success'] = true;
    
    //$result['data']['controller'] = $controller;
	//$result['data']['action'] = $action;
	$result['success'] = true;
     
} catch( Exception $e ) {
    //catch any exceptions and report the problem
    $result = array();
    $result['success'] = false;
    $result['errormsg'] = $e->getMessage();
}
 
//echo the result of the API call
echo json_encode($result);
exit();
