<?php
namespace Validations;

require_once ABSTRACT_VALIDATION_FOLDER . "abstractRegisterValidations.php";

use AbstractValidations\AbstractRegisterValidations;

class RegisterValidations extends AbstractRegisterValidations {
	// Array of keys => values of the register form fields	
	protected $fieldsValuesToValidate = array();
	protected $requiredFields = array();
	protected $notSetRequiredFields = array();
	protected $role, $mimetype;
	
	public function __constructor(array $fieldsValuesToValidate) {
		$this->setRequiredFields();
		$this->setFieldsValuesToValidate($fieldsValuesToValidate);
	}
	
	protected function setRequiredFields() {
		$this->requiredFields = array("email", "password");
	}
	
	// Set fieldsToValidate. Return FALSE if parameter is not null and TRUE otherwise
	protected function setFieldsValuesToValidate(array $fieldsValuesToValidate) {
	  if (! is_null($fieldsValuesToValidate)) {
         $this->$fieldsValuesToValidate = $fieldsValuesToValidate;
		 return TRUE;  	
      }
	  else {
	  	 throw new \Exception("Register validations: NULL ARRAY FIELDS VALUES TO VALIDATE");    
	  	 return FALSE;	
	  }
	}
	
	protected function validateFirstname() {
		$result = array();
		
		if (isset($fieldsValuesToValidate['firstname'])) {
		    $result['isValid'] = TRUE;
			$result['message'] = "Firstname is valid";
				
			return $result;
		}
		else {
			$result['isValid'] = FALSE;
			$result['message'] = "Firstname is not valid";
			
			return $result;
		}
	}
	protected function validateLastname() {
      return array();		
	} 
	protected function validateEmail() {
	  return array();	
	}
	protected function validateRole() {
		
	}
	protected function validateMimetype() {
	  return array();
	}
	protected function validatePassword() {
		
	}
	
	public function doValidate() {
		$result[];
		
		try {
		   // Check that the array of fields values to validate in not null
		   if (! isset($this->fieldsValuesToValidate)) {
		      throw new \Exception("Register Validations: ARRAY OF FIELDS TO VALIDATE NOT SET");
			   
			  $result["message"] = "Error - Array of fields values to validate not set";
			  $result["success"] = FALSE;
		   }
		   
		   // Check that the required fields are set in the fields of values to validate
		   for ($i = 0; $i < count($this->requiredFields); ++$i) {
		   	  if (! $this->fieldsValuesToValidate[$this->requiredFields[$i]] || $this->fieldsValuesToValidate[$this->requiredFields[$i]] === "") {
		   	  	$this->notSetRequiredFields[] = $this->requiredFields[$i];
		   	  }
		   }
		   
		   // Add the notSetFields array to the result
		   $result["notSetRequiredFields"] = $this->notSetRequiredFields;
		   
		   // Validate each field and add the result to $result array
		   $result['isValidFirstname'] = $this->validateFirstname();
		   $result['isValidLastname'] = $this->validateLastname();
		   $result['isValidEmail'] = $this->validateEmail();
		   $result['isValidPassword'] = $this->validatePassword();
		   $result['isValidRole'] = $this->validateRole();
		   $result['isValidMimetype'] = $this->validateMimetype();
		   	
		}
		catch (\Exception $expt) {
		   $result = array();
		   $result['success'] = FALSE;
		   $result['message'] = "Register Validation Exception: " . $expt->getMessage();
		   
		   throw $expt($result['message']);
		}
		return $result;
	}
	
} 
