<?php

namespace LoginServices;

require_once ABSTRACT_LOGIN_SERVICES_FOLDER . "abstractRegister.php";
require_once MODELS_FOLDER . "subscriber.php";

use AbstractLoginServices\AbstractRegister;
use Models\Subscriber;

class Register extends AbstractRegister {
	protected $subscriberModel;
/*
 * Following Zend create a bootstrap class that will create a database connection object
 * the boostrap will have a run method that is executed. The run method will instantiate the database connection.
 * Boostrap will be called in the index file. 
 */	
	public function doRegister (array $subscriber) {
		try {
			$subscriberModel = new Subscriber();
			$isSubscriberExist = $subscriberModel->isUserExistByEmail($subscriber['email']);
			
			if (! $isSubscriberExist['success']) {
				$result = array('success' => 'FALSE');
				throw new \Exception('Register - doRegister: Query did not succeed');
			}
			if (count($isSubscriberExist['data']) > 0) {
				$result = array('data' => $isSubscriberExist, 'success' => 'FALSE');	
				throw new \Exception('Register - doRegister(): This Email is taken');
			}
			
			// Do the insert here
			$result = $subscriberModel->save($subscriber);
		
		}	
		catch (\Exception $e) {
			$result = array();
			$result['success'] = FALSE;
			$result['message'] = "Register - doRegister Exception: " . $e->getMessage();
			
			throw new \Exception($result['message']);
	    }
		return $result;
    }
}