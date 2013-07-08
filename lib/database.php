
<?php

Class Database {

  public static function Read($query) {
    $cursor = mysql_query($query);
    return $cursor;
  }

  public static function Reader($cursor) {
    return mysql_fetch_array($cursor);
  }

  public static function save($table_name, $fields) {

    foreach ($fields as $field => $value) {
      $field_array[] = $field;
      $value_array[] = addslashes($value);
    }
    $create_key = array_search('created_at', $field_array);
		$update_key = array_search('updated_at', $field_array);
    if ($create_key)
      $value_array[$create_key] = date('Y-m-d H:i:s');
    if ($update_key)
      $value_array[$update_key] = date('Y-m-d H:i:s');

    $field_string = "(`" . implode('`,`', $field_array) . "`)";
    $value_string = "( '" . implode('\',\'', $value_array) . "')";
	// echo "INSERT INTO `" . $table_name . "`" . $field_string . " values " . $value_string; exit;
    return self::Read("INSERT INTO `" . $table_name . "`" . $field_string . " values " . $value_string);
  }

  public static function update($table_name, $fields, $where_array) {

    $update_key = array_search('updated_at', $fields);
    if ($update_key)
      $fields[$update_key] = date('Y-m-d H:i:s');


    $update_string = '';
    foreach ($fields as $field => $value) {
      $update_string .= "`" . $field . "` = '" . addslashes($value) . "' , ";
    }
    $update_string = substr($update_string, 0, strlen($update_string) - 2);

    $where_string = self::getWhereString($where_array);

    return self::Read("UPDATE `" . $table_name . "` SET " . $update_string . $where_string);
  }

  public static function getOneRecord($table_name, $where_array = array()) {

    $where_string = self::getWhereString($where_array);
		
    $q = self::Read("SELECT * FROM " . $table_name . $where_string);
    $result = mysql_fetch_assoc($q);
		
    if (is_bool($result)) {
      if (!$result) {
        return array();
      }
    } elseif (is_array($result)) {
      return $result;
    }
  }

  public static function delete($table_name, $where_array = array()) {

    $where_string = self::getWhereString($where_array);
	try{
    	$q = self::Read("DELETE FROM " . $table_name . $where_string);
	} catch(Exception $e) {
		echo "delete not done ";
		exit;
	}
	
	
  }

  public static function getNumRecords($table_name, $where_array = array()) {
		$where_string = Database::getWhereString($where_array);
			$q = self::Read("SELECT * FROM " . $table_name . $where_string);

    return mysql_num_rows($q);
  }

  public static function getWhereString($where_array) {
    $where_string = "";
		if (count($where_array) > 0) {
      $where_string = " WHERE ";
      foreach ($where_array as $field => $value) {
        $where_string .= $field . " = '" . $value . "' AND ";
      }
      $where_string = substr($where_string, 0, strlen($where_string) - 4);
    }   
    
    return $where_string;
  }
	
	
	public function getSearchQuery($table, $where_array , $order , $q = "") {
	if($q == "") {
		$q = "SELECT * FROM ".$table;
	} 
		if (count($where_array) > 0) {
      $where_string = " WHERE ";
      foreach ($where_array as $field => $value) {
			if($value != "") {
        $where_string .= $field . " like '%" . $value . "%' AND ";
			}
     }
		}
      $where_string = substr($where_string, 0, strlen($where_string) - 4);
			$q .= $where_string." ORDER BY ";
		foreach($order as $k => $v) {
			$q .= $k." ".$v;
		}
		// echo $q; exit;
		return $q;
	}
	
	public static function multiDelete($table, $post_array) {
	
	
		$id = implode(",", $post_array);			
		mysql_query("DELETE from ".$table." WHERE ID IN (".$id.")");
		
	}			


}

?>
