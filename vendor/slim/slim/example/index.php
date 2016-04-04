<?php

/**
 * Step 1: Require the Slim Framework using Composer's autoloader
 *
 * If you are not using Composer, you need to load Slim Framework with your own
 * PSR-4 autoloader.
 */
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Helpers\XMLUtilityFunctions;
use LoginServices\LoginProxy;

 //require 'vendor/autoload.php';
require_once "Helpers/customConstants.php"; 
require_once PATH_TO_SLIM_AUTOLOAD . "autoload.php";
require_once PATH_TO_MAILINGLIST_CONSTANTS . "application_constants.php";
require_once HELPERS_FOLDER . SERVICES_CONTROLLER_ACTION_MAPPER_FILE;
require_once PATH_TO_MAILINGLIST_CONSTANTS . "XMLUtilityFunctions.php";
require_once LOGIN_SERVICES_FOLDER . "loginProxy.php";

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new Slim\App();

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
 
 
 
$app->get('/', function ($request, $response, $args) {
	
	trigger_error("SLIM INDEX GET IN THE CONTROLLER");
    
	// Query parameters should include service and action
	// For example request for subscriber login will include service=login&action=read
	$requestParams = $request->getQueryParams();
	//trigger_error('SUBSCRIBER_CONTROLLER ' . SUBSCRIBERS_CONTROLLER);
	
	//CREATE AN XML FILE THAT WILL STORE ALL INFORMATION ABOUT CONTROLLERS
	//ELEMENT CONTROLLER; ATTRIBUTES: CONTROLLER NAME ...
	//CHILD ELEMENTS: FILE NAME; FILE PATH; ACTIONS
	//CHILD ELEMENTS FOR ACTIONS: READ, CREATE, DELETE, UPDATE
	
	// Load the XML controller mapper
	//$xmlControllerMapper = simplexml_load_file(SERVICES_CONTROLLER_ACTION_MAPPER_FILE);
	
	$xmlMappingFileFullPath = HELPERS_FOLDER . SERVICES_CONTROLLER_ACTION_MAPPER_FILE;
	$xmlControllerMapper = new XMLUtilityFunctions($xmlMappingFileFullPath);
	
	trigger_error("MAPPING FILENAME " . $xmlMappingFileFullPath);
	/*
	if ($requestParams['action'] === 'subscriberlogin') {
			
			// Read the XML file and get controller folder and filename - replace the values here
			// Get the controller and the action - replace the values here
			
			include_once CONTROLLERS_FOLDER . SUBSCRIBERS_CONTROLLERS_FILENAME;
			
			$subscribersController = SUBSCRIBERS_CONTROLLER;
			$subscribersController = new $subscribersController($requestParams);
			$method = "readAction"; 
			$responseFromController = $subscribersController->$method();
			//error_log(print_r($request->getHeaders(), TRUE));
			$newResponse = $response->withAddedHeader('Access-Control-Allow-Origin', 'http://mailinglistclient.local');
			//$newResponse_1 = $newResponse->withAddedHeader('Content-Type', 'application/json');
			//return json_encode($response);
			$body = $newResponse->getBody();
			$body->write($responseFromController);
			return $newResponse;
		}*/
	
	$serviceControllerData = $xmlControllerMapper->getControllerData($requestParams['service']);
	$controllerAction = $xmlControllerMapper->getActionName($requestParams['service'], $requestParams['action']);
	
	error_log(print_r($serviceControllerData, TRUE));
	
	//Call the service here. I supposed that the service controller data has been mofify to include
	//the key "service" => "servicename";
	$service = $serviceControllerData['serviceData']['className'];
	$serviceMethod = $serviceControllerData['serviceData']['serviceMethod'];
	
	
	
	// Get the controller data that will be passed to the service method
	$controllerData = $serviceControllerData['controllerData'];
	
	// The service should inherit from the interface. The interface has 
	// one method, the one whose the name is in the XML. That method should have two 
	// parameters. Array and string 
	
	$serviceClass = new $service();
	
	//$serviceClass = new LoginServices\LoginProxy($controllerData, $controllerAction, $requestParams);
	
	trigger_error("SERVICE CLASS NAME" . get_class($serviceClass));
	$serviceResult = $serviceClass->$serviceMethod($controllerData, $controllerAction, $requestParams);
	$resp = $response->withAddedHeader('Access-Control-Allow-Origin', 'http://mailinglistclient.local/');
	$body = $resp->getBody();
	$body->write($serviceResult);
	return $resp;
});

$app->get('/hello[/{name}]', function ($request, $response, $args) {
    $response->write("Hello, " . $args['name']);
    return $response;
})->setArgument('name', 'World!');



$app->get('/Subscribers[/{email}]', function ($request, $response, $args) {
	//include_once "../Controllers/subscribersController.php";
	
	
	$controller = "Controllers\\SubscribersController" ;
	$controller = new $controller($requestParameters);
	$response = $controller->$requestParameters['action']();
	
	//$newResponse = $response->withAddedHeader('Content-Type', 'application/json');
	$newResponse = $response->withAddedHeader('Access-Control-Allow-Origin', 'http://mailinglistclient.local/');
	
	return json_encode($newResponse);
});

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
