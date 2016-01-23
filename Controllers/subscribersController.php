<?php
namespace Controllers;

//The application_constant file is already included in the SLIM index.php
//require_once "../Helpers/application_constants.php";
require_once ABSTRACT_CONTROLLERS_FOLDER . "abstractSubscriberController.php";
require_once ABSTRACT_MODELS_FOLDER . "abstractSubscriberModel.php";
require_once MODELS_FOLDER . "subscriberModel.php";

use Models\SubscriberModel;
use AbstractModels\AbstractSubscriberModel;
use AbstractControllers\AbstractSubscriberController;

class SubscribersController extends AbstractSubscriberController {
	private $_params;
	private static $dsn;
	private $subscriberModel;
	 
    public function __construct($params = array())
    {
        $this->params = $params;
		
		//Set dsn value in a config file and get it from there.
		self::$dsn = 'mysql:host=localhost;dbname=mailinglistmanager_db';
		
		// This should be removed from here. Create a class that will return the PDO instance
		// and call it heret
    	SubscriberModel::setPDO(self::$dsn, 'root', 'admin');
		
		trigger_error("SUBSCRIBER CONTROLLER PARAMS - ");
		error_log(print_r($this->params, TRUE));
    }
	
	private function setSubscriberModel(AbstractSubscriberModel $subscriberModel) {
		$this->subscriberModel = $subscriberModel; 
  	}
	
	// Change this following the zend controller style. Add a private Subscriber property.
	// Create a set Subscriber Model method see how the DtTable class has been added in zend model
	public function createAction()
    {
       	trigger_error("SUBSCRIBER CONTROLLER ENTERING CREATE ACTION");
       //Create a new User 	
	   try {
	   	  //Set the model
	   	  $subscriberModel = new SubscriberModel();
		  $this->setSubscriberModel($subscriberModel);
		 
		  // START HERE. REMEMBER THAT THE CONTROLLER IS INITIALIZE WITH _PARAMS.
		  // USE THIS ARRAY AS PARAMETER OF MODEL->SAVE()
	      //$fields = $subscriberModel->toArray();
		
		//pass the user's username and password to authenticate the user
    	//$todo->save($this->_params['username'], $this->_params['userpass'], $this->_params);
     	  $result = $subscriberModel->save($this->params);
		
	   }
	   catch (\Exception $e) {
	   	  trigger_error($e->getMessage());
	   }		
	   	
		return $result;
    	
    }
    public function readAction()
	{
    	trigger_error("SUBSCRIBER CONTROLLER ENTERING READ ACTION");
		$result = array();
		
		try {
		  $subscriberModel = new SubscriberModel();
		  $this->setSubscriberModel($subscriberModel);
		  $fields = array('email', 'firstname', 'lastname', 'password','roleid', 'mimetype', 'createdDate', 'updatedDate');
		  
		  $result = $this->subscriberModel->fetch($fields, array('email' => $this->params['email']));
		  trigger_error("SUBSCRIBER CONTROLLER FINISHED READ ACTION");
		  error_log(print_r($result, TRUE));
		}
		catch (\Exception $e) {
			$result['success'] = FALSE;
			$result['message'] = $e->getMessage();
		}
		return $result;
    }
	public function updateAction()
	{
		
	}
	public function deleteAction()
	{
		
	} 
	 
}
