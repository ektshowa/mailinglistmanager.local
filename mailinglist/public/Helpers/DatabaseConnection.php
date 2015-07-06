<?php
namespace Helpers;

class DatabaseConnection {
	//Connection parameters
	private static $dsn = null;
	private static $user = null;
	private static $password = null;
	
	//Connection variable
	private static $handle;
	
	//Cannot be instantiated or cloned
	final private function __construct() {
	}
	final private function __clone() {		
	}
	
	//If connection success, return an array of connection handle and connection state equal true.
	//If connection failed, return an array of error message, connection handle null and connection state equal false. 
	public static function getDBHandle($dsn, $user, $password) {
		try {
			if (is_null($dsn) || is_null($user)) {
				throw new \Exception("Not Enough Connection parameters - dsn:{$dsn}, user:{$user}");
			}
			if (is_null($password)) {
				throw new \Exception('Trying to connect without password');			
			}
			// Connect if not already connected
			if (is_null(self::$handle)) {
				self::$handle = new \PDO($dsn, $user, $password);
				self::$handle->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			} 
			$result['success'] = TRUE;
			$result['dbHandle'] = self::$handle;
		}
		catch (\PDOException $pe){
			$result = array();
			$result['success'] = FALSE;
			$result['dbHandle'] = null;
			$result['errormsg'] = $pe->getMessage();
		}
		return $result;
	}
}