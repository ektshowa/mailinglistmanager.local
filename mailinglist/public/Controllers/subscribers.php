<?php
namespace Controllers;

include_once "Helpers/application_constants.php";
include_once ABSTRACT_CONTROLLERS_FOLDERS . "abstractSubscriber.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Models/subscriber.php";

use Models\Subscriber;
use AbstractControllers\AbstractSubscriberController;

class Subscribers extends AbstractSubscriberController {
	private $_params;
	private static $dsn;
	 
    public function __construct($params)
    {
        $this->_params = $params;
		
		//Set dsn value in a config file and get it from there.
		self::$dsn = 'mysql:host=localhost;dbname=mailinglistmanager_db';
    	Subscriber::setPDO(self::$dsn, $this->_params['username'], $this->_params['password']);
    }
	
	public function createAction()
    {
       //Create a new User 	
	   $subscriber = new Subscriber();		
	   $subscriber->setEmail($this->params['email']);
	   $subscriber->setFirstname($this->params['firstname']);		
	   $subscriber->setLastname($this->params['lastname']);
	   $subscriber->setPassword($this->params['password']);
	   $subscriber->setRole($this->params['role']);
	   $subscriber->setMimetype($this->params['mimetype']);		
		
	   $fields = $subscriber->toArray();
		
		//pass the user's username and password to authenticate the user
    	//$todo->save($this->_params['username'], $this->_params['userpass'], $this->_params);
     	$result = $subscriber->save($fields);
		
    	return $result;
    	
    }
    public function readAction()
	{
    	
    }
	public function updateAction()
	{
		
	}
	public function deleteAction()
	{
		
	} 
	 
}
