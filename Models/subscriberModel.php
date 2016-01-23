<?php
namespace Models;

require_once ABSTRACT_MODELS_FOLDER . "abstractSubscriberModel.php";
require_once HELPERS_FOLDER . 'databaseConnection.php';
require_once HELPERS_FOLDER . 'dbUtils.php'; 

use AbstractModels\AbstractSubscriberModel;
use Helpers\DBUtils;
use Helpers\DatabaseConnection;

class SubscriberModel extends AbstractSubscriberModel {
		
	private $id;
	private $email;
	private $firstname;
	private $lastname;
	private $password;
	private $role;
	private $mimetype;
	private $table;
	private $dbutils;
	private $createdDate;
	private $updatedDate;
	private static $pdo;
	
	public function __construct($tableName = "users") {
		$this->dbutils = new DBUtils();
		$this->table = $tableName;	
	}
	
	private function setCreatedDate() {
		$this->createdDate = date('Y-m-d H:i:s');
	}
	
	private function setUpdatedDate() {
		$this->updatedDate = date('Y-m-d H:i:s');
	}
	
	
	public function toArray() {
			$fields = array('email', 'firstname', 'lastname', 'password','role', 'mimetype', 'createdDate', 'updatedDate');
			$returnedArray = array();
			
			/*
			for ($i = 0; $i < count($fields); ++$i) {
						  if (!is_null($this->$$fields[$i])) {
							//$$fields[$i] = $this->$fields[$i];
							$returnedArray[$fields[$i]] = $this->$$fields[$i];
						  }
						}*/
			
			return $returnedArray;
		}
	
	
	public function getChild($userid) {
		
	}
	
	//Set a PDO Object
	public static function setPDO($dsn, $username, $userpass){
		
		//Get the Connection array
		self::$pdo = DatabaseConnection::getDBHandle($dsn, $username, $userpass);
	}
	
	public function getId() {
			if (is_integer($this->id) && $this->id > 0) {
				return $this->id;		
			}
			else {
				return FALSE;
			}
	}
	
	public function setId($userId) {
		if (is_integer($userId) && $userId > 0) {
			$this->id = $userId;
			return TRUE;
		}
		else {
			$this->id = null;
			throw new \Exception("Subscriber Model - setId(): Not a valide User ID");
			return FALSE;
		}	
	}
	
	public function setEmail($email) {
		if (strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->email = $email;
			return TRUE;	
		}
		else {
			$this->email = null;
			throw new \Exception("Subscriber Model - setEmail(): Not valide email");
			return FALSE;
		}
		
	}
	
	public function getEmail() {
		if (!empty($this->email)) {
			return $this->email;
		}
		else {
			throw new \Exception("Subscriber Model - getEmail(): Email not set ");
			return FALSE;
		}
	}
	
	public function getFirstname() {
		return $this->firstname;
	} 
	
	public function setFirstname($firstname) {
		if (strlen($firstname) > 0) {
			$this->firstname = $firstname;
			return TRUE;	
		}
		else {
			$this->firstname = null;
			throw new \Exception("Subscriber Model: Trying to set the firstname with empty string");
			return false;
		}
	}
	
	public function getLastname() {
		if (!empty($this->lastname)) {
			return $this->lastname;	
		}
		else {
			throw new \Exception("Subscriber Model: Lastname not set");
			return FALSE;
		}
	}
	
	public function setLastname($lastname) {
		if (strlen($lastname) > 0) {
			$this->lastname = $lastname;
			return TRUE;
		}
		else {
			$this->lastname = null;
			throw new \Exception("Subscriber Model: Trying to set the lastname with empty string");
			return false;
		}
	}
	
	public function getName() {
			
		if (!empty($this->firstname) && !empty($this->lastname)) {
			return $this->firstname . " " . $this->lastname;	
		}
		else {
			throw new \Exception("Subscriber Model: Firstname or Lastname not set");
			return FALSE;
		}
	}
	
	public function setName($firstname="", $lastname="") {
		if (strlen($firstname) > 0 && strlen($lastname) > 0) {
			$this->firstname = $firstname;
			$this->lastname = $lastname;
			return TRUE;
		}
		else {
			throw new \Exception("Subscriber Model - setName(): Missing firstname and lastname parameters");
			return FALSE;
		}
	}
	
	public function setPassword($password) {
		if (!empty($password)) {
			$this->password = sha1($password);
			return TRUE;
		}
		else {
			$this->password = null;
			throw new \Exception("Subscriber Model - setPassword(): No parameter value");
			return FALSE;
		}
	}
	
	public function getPassword() {
		if (strlen($this->password) > 0) {
			return $this->password;
		}
		else {
			throw new \Exception("Subscriber Model - getPassword(): Password not set");
			return FALSE;
		}
	}
	
	public function setRole($role) {
		if (!empty($role)){
			$this->role = $role;
			return TRUE;
		}
		else {
			$this->role = null;
			throw new \Exception("Subscriber Model - setRole(): Parameter not set");
			return FALSE;
		}
	}
	
	public function getRole() {
		if (!empty($this->role)) {
			return $this->role;
		}
		else {
			throw new \Exception("Subscriber Model - getRole(): Role nor set");
			return FALSE;
		}
	}
	
	public function setMimetype($mimetype) {
		if (!empty($mimetype)) {
			$this->mimetype = $mimetype;
			return TRUE;
		}
		else {
			$this->mimetype = null;
			throw new \Exception("Subscriber Model - setMimetype(): Parameter not set");
			return FALSE;
		}
	}
	
	public function getMimetype() {
		if (!empty($this->mimetype)) {
			return $this->mimetype;
		}
		else {
			throw new \Exception("Subscriber Model - getMimetype(): Mimetype not set");
			return FALSE;
		}
	}
	
	public function save(array $params)
    {
    	try {
    	  if (! empty($params)) {
    	    // Set the Model properties	
    	    if (isset($params['id'])) {
    	    	$this->setId($params['id']); 		
    	    }
    	    if (isset($params['email'])) {	
    		  $this->setEmail($params['email']);
			}
			if (isset($params['firstname'])) {
			  $this->setFirstname($params['firstname']);
			}
			if (isset($params['lastname'])) {		
	          $this->setLastname($params['lastname']);
			}
			if (isset($params['password'])) {
	          $this->setPassword($params['password']);
			  $this->password = md5($this->password);	
	        }
	        if (isset($params['role'])) {
	          $this->setRole($params['role']);
			}
			if (isset($params['mimetype'])) {
	          $this->setMimetype($params['mimetype']);		
			}
		  }
		}
		catch (\Exception $e) {
		  $result['success'] = FALSE;
		  $result['message'] = $e->getMessage();
		  return $result;	
    	} 
    	
		try {
		  if ($this->id) {
		  	//Set updatedDate to current datetime. else set createdate.
		  	$this->setUpdatedDate();
		  }
		  else {
		  	$this->setCreatedDate();
		  }	
		  // TO TEST THIS CREATE THE ASSOCIATIVE SUBSCRIBER ARRAY DIRECTLY FROM THE PROPERTY OF THE MODEL INSTANCE
		  // REPLACE WITH toArray METHOD WHEN THIS STEP IS DONE
		  //$subscriber = $this->toArray();
		  $subscriber = array(
		                      
			                       'id' => $this->id,
							       'firstname' => $this->firstname,
							       'lastname' => $this->lastname,
							       'email' => $this->email,
							       'password' => $this->password,
							       'roleid' => $this->role,
							       'mimetype' => $this->mimetype,
							       'createdDate' => $this->createdDate
			                 
					      );
		  
		  //If the connection has been successfully created
          if (self::$pdo['success']) {
        	  $result = $this->dbutils->build_save_update_query(self::$pdo['dbHandle'], $subscriber, $this->table);
          }
		  else {
		      throw new Exception("Subscriber save - " . self::$pdo['errormsg']);
			  $result['success'] = FALSE;
			  $result['errormsg'] = self::$pdo['errormsg'];
		  }
		}
		catch (\Exception $e) {
		  $result['success'] = FALSE;
		  $result['errormsg'] = $e->getMessage(); 	
		}	
    	return $result;
    }
    
    public function fetch($fields, $filters = array()) {
		if (self::$pdo['success']) {
			$result = $this->dbutils->build_single_table_select(self::$pdo['dbHandle'], $this->table, $fields, $filters);
			//trigger_error("SUBSCRIBER MODEL FETCH RESULT");
			//error_log(print_r($result, TRUE));
		}
		else {
			throw new \Exception("Subscriber fetch - " . self::$pdo['errormsg']);
			$result['success'] = FALSE;
			$result['errormsg'] = self::$pdo['errormsg'];
		}
		return json_encode($result);
	}
    
	//Check if the subscriber exists using SubscriberID. Return email and password. 
	public function isUserExistByID($subscriberid){
		//Get the user if the connection is successfull	
		if (self::$pdo['success']) {
        	$result = $this->dbutils->build_single_table_select(self::$pdo['dbHandle'], $$this->table, array('id', 'email', 'password'), array('id' => $subscriberid));
        }
		else {
			throw new \Exception("Subscriber fetch - " . self::$pdo['errormsg']);
			$result['success'] = FALSE;
		}
		return $result['success'];
	} 
	
	//Check if the subscriber exists using using Email. Return email and password.
	public function isUserExistByEmail($email) {
		//Get the user if connection is successful
		if (self::$pdo['success']) {
        	$result = $this->dbutils->build_single_table_select(self::$pdo['dbHandle'], $$this->table, array('id', 'email', 'password'), array('email' => $email));
        }
		else {
			throw new \Exception("Subscriber fetch - " . self::$pdo['errormsg']);
			$result['success'] = FALSE;
		}
		return $result['success'];
	}

    //Check subscriber credential. Return array with keys: boolean 'success', array 'data' 
    public function checkSubscriberCredentials($email, $password) {
    	if (self::$pdo['success']) {
    		$password = sha1($password);
    		$fields = array('id', 'firstname', 'lastname', 'role', 'mimetype');
			$filters = array('email' => $email, 'password' => $password);
			
    		$result = $this->dbutils->build_single_table_select(self::$pdo['dbHandle'], $$this->table, $fields, $filters);
    	}
		else {
			throw new \Exception("Subscriber checkSubscriberCredential - " . self::$pdo['errormsg']);
			$result['success'] = FALSE;
			$result['errormsg'] = self::$pdo['errormsg'];
		}
		return $result;
    }
	
	public function addUser($subscriber){
		
	}
	
	public function removeUser($subscriber){
		
	}
    
}
