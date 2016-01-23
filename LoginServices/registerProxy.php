<?php
namespace LoginServices;

require_once ABSTRACT_LOGIN_SERVICES_FOLDER . "abstractRegister.php";
require_once ABSTRACT_VALIDATIONS_FOLDER . "abstractRegisterValidations.php";
require_once VALIDATIONS_FOLDER . "registerValidations.php";
require_once LOGIN_SERVICES_FOLDER . "register.php";

use AbstractLoginServices\AbstractRegister;
use AbstractValidations\AbstractRegisterValidations;
use Validations\RegisterValidations;
use LoginServices\Register;

class RegisterProxy extends AbstractRegister {
	
	protected $subscriber = array();
	protected $validations;
	
    protected function setEmail(){
		$this->email = htmlentities($_POST['email']);
		unset($_POST['email']);
	}
	protected function setFirstname(){
		$this->firstname = htmlentities($_POST['firstname']);
		unset($_POST['firstname']);
	}
	protected function setLastname(){
        $this->lastname = htmlentities($_POST['lastname']);
		unset($_POST['lastname']);		
	}
    protected function setRole(){
    	$this->role = htmlentities($_POST['role']);
		unset($_POST['role']);
    }
	protected function setMimetype(){
		$this->mimetype = htmlentities($_POST['mimetype']);
		unset($_POST['mimetype']);
	}
	protected function setPassword(){
		$this->password = htmlentities($_POST['password']);
		unset($_POST['password']);
	}
	
	// Associative array of subscriber's model
	protected function getSubscriber() {
	  $this->subscriber['firstname'] = $this->setFirstname();
	  $this->subscriber['lastname'] = $this->setLastname();
	  $this->subscriber['email'] = $this->setEmail();
	  $this->subscriber['role'] = $this->setRole();
	  $this->subscriber['mimetype'] = $this->setMimetype();
	  $this->subscriber['password'] = $this->setPassword();	
	}
	// Set the local Validate class 
	protected function setValidate(AbstractRegisterValidation $validations){
        // Add a try catch to throw exception when subscriber array is null	
        // Use Composition to instantiate the Registration  
        $this->validations = new RegisterValidations($this->subscriber);	
	}
	
	// Do validations with the Registervalidations class
	public function doRegisterValidations(){
		// Validate the register fields
		$this->validations = new RegisterValidations($this->getSubscriber());
		$validationResult = $this->validations->doValidations();
	
	    try {
	       // If the validation is a success do registration
		   if ($validationResult['success']) {
			   // Call the registration class to do the registration
			   $register = new Register();
			   $register->doRegister($this->subscriber);
		   }
		   // return the validation result
           else {
        	  return $validationResult;
           }	
	    }
		catch (\Exception $e) {
		   	
		}	
		
	}
	
	
	//TODO: encode post parameters and use them in the request as json. See the example in previous API
		
		
}
        
