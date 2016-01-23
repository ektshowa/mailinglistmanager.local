<?php
namespace Helpers; 

class DBUtils {
	
	/**	Build the update or save query
	 *	Parameters are Connection object:$db, row identifier(table primary key):$key_field, 
	 *	array of table columns with their values:$request_params, table name:$table  
	**/
	public function build_save_update_query(\PDO $db, array $request_params, $table, $key_field = null){
		$values = array();
		$result = array();
		
		try {
			if (! strlen($table) > 0 || !is_string($table)) {
				$result['success'] = FALSE;
				$result['message'] = "DBUtil - build_save_update_query: parameter table must be set and should be a string";
				throw new \Exception($result['message']);
			} 
			else {
			   if (! is_null($request_params[$key_field])){
				  //Get the key field's value and delete it from the request params array
				  $key_field_value = $request_params[$key_field];
				  unset($request_params[$key_field]);
			
				  $update_fields = array();
				  foreach ($request_params as $key => $value){
					 $update_fields[] = "$key = ?";
					 $values[] = $value;  
				  }
				  //Add the key field's value to the $values array
				  $values[] = $key_field_value;
				  $st = $db->prepare("UPDATE $table SET " .
							implode(',', $update_fields) .
							" WHERE $key_field = ?");
			   }
			   else {
				  $placeholders = array();
				  $fields = array_keys($request_params);
				  $values = array_values($request_params);
			
				  for ($i = 0; $i < count($request_params); $i++){
					  $placeholders[] = '?';
				  }
				  $st = $db->prepare("INSERT INTO $table (" . implode(',', $fields) . ") VALUES (" .
							implode(',', $placeholders) . ")");
			   }
			   $st->execute($values);
			   $result['success'] = TRUE;
		   }
		}
		catch(PDOException $pe){
			$result['success'] = FALSE;
			$result['errormsg'] = $pe->getMessage();
		}
			
		return json_encode($result);
	} 

	/**	Build a select query on a single table
	 *	Parameters are DatabaseConnection object:$db, String table name:$table, Array names of the columns to retrieve:$select_fields,
	 *  Associative Array columns to filter on with their values:$where_fields
	**/
	public function build_single_table_select($db, $table, $select_fields, $where_fields = array()) {
		$result = array();
		
		trigger_error("SUBSCRIBER CONTROLLER - MODEL - BUILD SELECT QUERY");
		
		try {
			if (! empty($select_fields)) {
				$fields = array_keys($where_fields);
				$values = array_values($where_fields);
				
				if (isset($where_fields) && !empty($where_fields)) {
					$i = 0;
					$select_string = "SELECT " . implode(",", $select_fields) .
								 " FROM $table WHERE " ;
											 
					for ($i = 0; $i < count($fields); ++$i) {
						$select_string .= " $fields[$i] = ? ";
						
						if ($i < count($fields) - 1) {
							$select_string .= "and ";
						}		
					}
					$st = $db->prepare($select_string);
					$st->execute($values);
					$result['data'] = $st->fetchAll();	
				}
				else {
					$select_string = "SELECT " . implode(",", $select_fields) .
								 	 " FROM $table" ;
					$st = $db->prepare($select_string);
					$st->execute();
					$result['data'] = $st->fetchAll();
				}
				$result['success'] = TRUE;				 
			}
			else {
					$result['success'] = FALSE;
					$result['errormsg'] = 'BUILD SELECT QUERY ERROR: NO SELECT FIELD PROVIDED';
			}	
		}
		catch (PDOException $pe) {
			$result['success'] = FALSE;
			$result['errormsg'] = $pe->getMessage();
		}
		return json_encode($result);
	}
}
