<?php
namespace Models;

require_once ABSTRACT_MODELS_FOLDER . "abstractSubscriberModel.php";
//require_once HELPERS_FOLDER . 'databaseConnection.php';
//require_once HELPERS_FOLDER . 'dbUtils.php'; 

use AbstractModels\AbstractSubscriberModel;
//use Helpers\DBUtils;
//use Helpers\DatabaseConnection;

/**
 * @Entity @Table(name="users")
 **/
class SubscriberModel extends AbstractSubscriberModel {
	/**
	 * @var int
	 * @Id @Column(type="integer") @GeneratedValue
	 */	
	protected $id;
	
	/**
	 * @var string
	 * @Column(type="string")
	 */
	protected $email;
	
	/**
	 * @var string
	 * @Column(type="string")
	 */
	protected $firstname;
	
	/**
	 * @var string
	 * @Column(type="string")
	 */
	protected $lastname;
	
	/**
	 * @var string
	 * @Column(type="string")
	 */
	protected $password;
	
	/**
	 * @var string
	 * @Column(type="string")
	 */
	protected $role;
	
	/**
	 * @var string
	 * @Column(type="string")
	 */
	protected $mimetype;
	
	/**
	 * @var string
	 * @Column(type="string")
	 */
	 protected $addressline1;
	 
	 /**
	 * @var string
	 * @Column(type="string")
	 */
	 protected $addressline2;
	
	//private $table;
	//private $dbutils;
	
	/**
	 * @var DateTime
	 * @Column(type="datetime")
	 */
	protected $createdDate;
	
	/**
	 * @var DateTime
	 * @Column(type="datetime")
	 */
	protected $updatedDate;
	//private static $pdo;
	
	public function __construct() {
		//$this->dbutils = new DBUtils();
		//$this->table = $tableName;	
	}
		
	public function getId() {
			if ($this->id > 0) {
				$result['success'] = TRUE;
				$result['data'] = $this->id;		
			}
			else {
				$result['success'] = FALSE;
				$result['message'] = "Subscriber Model - getId(): Id not set";
			}
			return $result;
	}
	/*
	public function setId($id) {
		if (!$id > 0) {
			$this->id = $id;
			return TRUE;
		}
		else {
			trigger_error("Subscriber Model - setId(): Parameter not set");
			return FALSE;
		}
	}
	*/
	
	public function setEmail($email) {
		//if (strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
		if (!empty($email)) {
			$this->email = $email;
			return TRUE;	
		}
		else {
			$this->email = null;
			trigger_error("Subscriber Model - setEmail(): Parameter not set");
			return FALSE;
		}
		
	}
	
	public function getEmail() {
		if (!empty($this->email)) {
			$result['data'] = $this->email;
			$result['success'] = TRUE;
		}
		else {
			$result['message'] = "Subscriber Model - getEmail(): Email not set";
			$result['success'] = FALSE;
		}
		return $result;
	}
	
	public function getFirstname() {
		if (!empty($this->firstname)) {
			$result['data'] = $this->firstname;
			$result['success'] = TRUE;
		}
        else {
        	$result['success'] = FALSE;
			$result['message'] = "Subscriber Model - getFirstname(): Firstname not set";
        }
		return $result;
	} 
	
	public function setFirstname($firstname) {
		if (!empty($firstname)) {
			$this->firstname = $firstname;
			return TRUE;	
		}
		else {
			$this->firstname = null;
			trigger_error("Subscriber Model: setFirstname(): Parameter not set");
			return false;
		}
	}
	
	public function getLastname() {
		if (!empty($this->lastname)) {
			$result['data'] = $this->lastname;
			$result['success'] = TRUE;	
		}
		else {
			$result['message'] = "Subscriber Model: getLastname(): Lastname not set";
			$result['success'] = FALSE;
		}
		return $result;
	}
	
	public function setLastname($lastname) {
		if (strlen($lastname) > 0) {
			$this->lastname = $lastname;
			return TRUE;
		}
		else {
			$this->lastname = null;
			trigger_error("Subscriber Model: setLastname(): Parameter not set");
			return false;
		}
	}
	
	public function setPassword($password) {
		if (!empty($password)) {
			//Encrypt the password. The hash used is the current timestamp.
			//Put this code in the ModelMapper in a function that will be 
			//called before to persist the password in the database.
			/*
			$algorithm = MCRYPT_BLOWFISH;
			$key = (string)time();
			$mode = MCRYPT_MODE_CBC;
			
			$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode), MCRYPT_DEV_URANDOM);
			$encryptedPassword = mcrypt_encrypt($algorithm, $key, $password, $mode, $iv);
			$encryptedPassword = base64_encode($encryptedPassword);
			 */
			$this->password = $password;
			return TRUE;
		}
		else {
			$this->password = null;
			trigger_error("Subscriber Model - setPassword(): Parameter not set");
			return FALSE;
		}
	}
	
	public function getPassword() {
		if (!empty($this->password)) {
			$result['data'] = $this->password;
			$result['success'] = TRUE;
		}
		else {
			$result['message'] = "Subscriber Model - getPassword(): Password not set";
			$result['success'] = FALSE;
		}
		return $result;
	}
	
	public function setRole($role) {
		if (!empty($role)){
			$this->role = $role;
			return TRUE;
		}
		else {
			$this->role = null;
			trigger_error("Subscriber Model - setRole(): Parameter not set");
			return FALSE;
		}
	}
	
	public function getRole() {
		if (!empty($this->role)) {
			$result['data'] = $this->role;
			$result['success'] = TRUE;
		}
		else {
			$result['message'] = "Subscriber Model - getRole(): Role nor set";
			$result['success'] = FALSE;
		}
		return $result;
	}
	// ADD ADDRESSLINE1 AND 2
	// REMOVE THE EXCEPTIONS AND USE AN ARRAY RESULT WITH KEYS MESSAGE AND SUCCESS AND DATA. DO IT FOR ALL THE ENTITIES
	// THE KEY RESU
	public function getAddressline1() {
		//If the field is not empty set the data, else set the message.
		if (!empty($this->addressline1)) {
			$result['success'] = TRUE;
			$result['data'] = $this->addressline1;
		}
        else {
        	$result['success'] = FALSE;
			$result['message'] = "Subscriber Model - getAddressline1(): Addressline1 not set";
        }
		return $result; 
	}
	
	public function setAddressline1($addressline1) {
		if (!empty($addressline1)) {
			$this->addressline1 = $addressline1;
			return TRUE;
		}
		else {
			$this->addressline1 = null;
			trigger_error("Subscriber Model - setAddressline1(): Parameter not set");
			return FALSE;
		}
	}
	
	public function getAddressline2() {
		//If the field is not empty set the data, else set the message.
		if (!empty($this->addressline2)) {
			$result['success'] = TRUE;
			$result['data'] = $this->addressline2;
		}
        else {
        	$result['success'] = FALSE;
			$result['message'] = "Addressline2 is empty";
        } 
		return $result;
	}
	
	public function setAddressline2($addressline2) {
		if (!empty($addressline2)) {
			$this->addressline2 = $addressline2;
			return TRUE; 
		}
		else {
			$this->addressline2 = null;
			trigger_error("Subscriber Model - setAddressline2(): Parameter not set");
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
			trigger_error("Subscriber Model - setMimetype(): Parameter not set");
			return FALSE;
		}
	}
	
	public function getMimetype() {
		if (!empty($this->mimetype)) {
			$result['success'] = TRUE;
			$result['data'] = $this->mimetype;
		}
		else {
			$result['message'] = "Subscriber Model - getMimetype(): Mimetype not set";
			$result['success'] = FALSE;
		}
		return $result;
	}
	
	public function setCreatedDate(DateTime $createDate) {
		if (!empty($createDate)) {
			$this->createdDate = $createDate;
			return TRUE;
		}
		else {
			$this->createdDate = null;
			trigger_error("Subscriber Model - setCreatedDate(): Parameter not set");
			return FALSE;
		}
	}
	
	public function getCreatedDate() {
		if (!empty($this->createdDate)) {
			$result['success'] = TRUE;
			$result['data'] = $this->createdDate;
		}
		else {
			$result['message'] = "Subscriber Model - getCreatedDate(): CreatedDate not set";
			$result['success'] = FALSE;
		}
		return $result;
	}
	
	public function setUpdatedDate(DateTime $updatedDate) {
		if (!empty($updatedDate)) {
			$this->updatedDate = $updatedDate;
			return TRUE;
		}
		else {
			$this->updatedDate = null;
			trigger_error("Subscriber Model - setUpdatedDate(): Parameter not set");
			return FALSE;
		}
	}
	
	public function getUpdatedDate() {
		if (!empty($this->updatedDate)) {
			$result['success'] = TRUE;
			$result['data'] = $this->updatedDate;
		}
		else {
			$result['message'] = "Subscriber Model - getUpdatedDate(): UpdatedDate not set";
			$result['success'] = FALSE;
		}
		return $result;
	}
	
	
	/*
	 * 
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
	
	 * 
	 * 
	/*
	public function toArray() {
				$fields = array('email', 'firstname', 'lastname', 'password','role', 'mimetype', 'createdDate', 'updatedDate');
				$returnedArray = array();
				
				/*
				for ($i = 0; $i < count($fields); ++$i) {
							  if (!is_null($this->$$fields[$i])) {
								//$$fields[$i] = $this->$fields[$i];
								$returnedArray[$fields[$i]] = $this->$$fields[$i];
							  }
							}
				
				return $returnedArray;
			}
	
	
	//Set a PDO Object
	//public static function setPDO($dsn, $username, $userpass){
		
		//Get the Connection array
	//	self::$pdo = DatabaseConnection::getDBHandle($dsn, $username, $userpass);
	//}
	 * 
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
	*/
	    
}
