<?php
namespace Models;

include_once ABSTRACT_MODELS_FOLDER . "AbstractSubscriber.php";
include_once HELPERS_FOLDER . 'DatabaseConnection.php';
include_once HELPERS_FOLDER . 'DBUtils.php'; 

use AbstractModels\AbstractSubscriber;
use Helpers\DBUtils;
use Helpers\DatabaseConnection;

class Subscriber extends AbstractSubscriber {
		
	private $id;
	private $email;
	private $firstname;
	private $lastname;
	private $password;
	private $role;
	private $mimetype;
	private $table;
	private $dbutils;
	
	public function __construct($tableName = "users") {
		$this->dbutils = new DBUtils();
		$this->table = $tableName;	
	}
	
	public function toArray() {
		return array(
			'id' 		=> $this->id,
			'email'		=> $this->email,
			'firstname'	=> $this->firstname,
			'lastname'	=> $this->lastname,
			'password'	=> $this->password,
			'role'		=> $this->role,
			'mimetype'	=> $this->mimetype
		);
		
	}
	
	public function getChild($userid) {
		
	}
	
	//Set a PDO Object
	public static function setPDO($dsn, $username, $userpass){
		
		//Get the Connection array
		return DatabaseConnection::getDBHandle($dsn, $username, $userpass);
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
		if (strlen($firstname) > 0) {
			$this->lastname = $lastname;
			return TRUE;
		}
		else {
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
       //If the connection has been successfully created
        if (self::$pdo['success']) {
        	$result = $this->dbutils->build_save_update_query(self::$pdo['dbHandle'], 'id', $params, $this->table);
        }
		else {
			throw new Exception("Subscriber save - " . self::$pdo['errormsg']);
			$result['success'] = FALSE;
			$result['errormsg'] = self::$pdo['errormsg'];
		}
		
        //return the array version
        return $result;
    }
    
    public function fetch($fields, $filters = array()) {
		if (self::$pdo['success']) {
			$result = $this->dbutils->build_single_table_select(self::$pdo['dbHandle'], $$this->table, $fields, $filters);
		}
		else {
			throw new \Exception("Subscriber fetch - " . self::$pdo['errormsg']);
			$result['success'] = FALSE;
			$result['errormsg'] = self::$pdo['errormsg'];
		}
		return $result;
	}
    
	//Check if the subscriber exists. Return email and password. 
	public function isUserExist($subscriberid){
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
