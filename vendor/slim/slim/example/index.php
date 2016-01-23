<?php

/**
 * Step 1: Require the Slim Framework using Composer's autoloader
 *
 * If you are not using Composer, you need to load Slim Framework with your own
 * PSR-4 autoloader.
 */
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

 //require 'vendor/autoload.php';
require_once "Helpers/customConstants.php"; 
require_once PATH_TO_SLIM_AUTOLOAD . "autoload.php";
require_once PATH_TO_MAILINGLIST_CONSTANTS . "application_constants.php";

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
    
	$requestParams = $request->getQueryParams();
	trigger_error('SUBSCRIBER_CONTROLLER ' . SUBSCRIBERS_CONTROLLER);
	
	//CREATE AN XML FILE THAT WILL STORE ALL INFORMATION ABOUT CONTROLLERS
	//ELEMENT CONTROLLER; ATTRIBUTES: CONTROLLER NAME ...
	//CHILD ELEMENTS: FILE NAME; FILE PATH; ACTIONS
	//CHILD ELEMENTS FOR ACTIONS: READ, CREATE, DELETE, UPDATE
	if ($requestParams['action'] === 'subscriberlogin') {
		
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
	}
	
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
