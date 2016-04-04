<?php
namespace Controllers;

//The application_constant file is already included in the SLIM index.php
//require_once "../Helpers/application_constants.php";
require_once ABSTRACT_CONTROLLERS_FOLDER . "abstractSubscriberController.php";
require_once ABSTRACT_MODELS_FOLDER . "abstractSubscriberModel.php";
require_once MODELS_FOLDER . "subscriberModel.php";
require_once MODELS_FOLDER . SUBSCRIBER_MODELMAPPER_FILENAME;

//use Models\SubscriberModel;
//use AbstractModels\AbstractSubscriberModel;
use AbstractLoginServices\AbstractLoginProxy;
use LoginServices\LoginProxy;
use AbstractControllers\AbstractSubscriberController;
use Models\SubscriberModelMapper;

class SubscribersController extends AbstractSubscriberController {
	protected $_params;
	protected static $dsn;
	protected $subscriberModel;
	protected $subscriberModelMapper;
	 
    public function __construct($params = array())
    {
        $this->params = $params;
		
		/*
		//Set dsn value in a config file and get it from there.
				self::$dsn = 'mysql:host=localhost;dbname=mailinglistmanager_db';
				
				// This should be removed from here. Create a class that will return the PDO instance
				// and call it heret
				SubscriberModel::setPDO(self::$dsn, 'root', 'admin');*/
		
		
		trigger_error("SUBSCRIBER CONTROLLER PARAMS - ");
		error_log(print_r($this->params, TRUE));
    }
	
	// REPLACE THIS WITH THE SUBSCRIBER MAPPER
	//private function setSubscriberModel(AbstractSubscriberModel $subscriberModel) {
	//	$this->subscriberModel = $subscriberModel; 
  	//}
	
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
	
    public function loginSubscriber()
	{
    	trigger_error("SUBSCRIBER CONTROLLER ENTERING READ ACTION");
		
		//The array that will be returned to the service
		$thisresult = array();
		
		try {
		   $this->subscriberModelMapper = new SubscriberModelMapper();	
		   
		   $result = $this->subscriberModelMapper->fetchSubscriberByCredentials($this->params['username'], $this->params['password']);
		   if ($result['success'] == TRUE) {
		   	   
		   	   // HERE GET VALUE OF RESULT['DATA']
		   	   $thisresult['data'] = $result['data'];
			   $thisresult['sucess'] = TRUE;
		   }
		}	
	    catch (\Exception $e) {
	    	$thisresult['success'] = FALSE;
			$thisresult['message'] = $e->getMessage();
	    }
		unset($result);
		return json_encode($thisresult);
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
