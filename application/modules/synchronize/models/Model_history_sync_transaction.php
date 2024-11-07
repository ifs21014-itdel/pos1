<?php

/**
 * Model history_sync_transaction
 * 
 * @author Rizal.Gurning
 */
class Model_history_sync_transaction extends MY_Model {
	
	public $table_name = "history_sync_transaction";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get_history_sync_transaction($starting_point="", $store_id){
		$query = "select id, table_name, status, data_id, query from history_sync_transaction " . 
		" where id > ? and store_destination_id=? order by id";
		$param = array(
			$starting_point,
			$store_id
		);
		return $this -> execute_query_as_result($query, $param);
	}
	
	function get_last_id_history_sync_transaction(){
		$query = "select COALESCE(max(id),0) as last_id from history_sync_transaction ";
		$param = array ();
		$result = $this -> execute_query($query, $param) -> row();
		$value = "0";
		if(isset($result)){
			$value = $result -> last_id;
		}
		return $value;
	}
}