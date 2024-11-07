<?php
/**
 * @author Rizal Gurning
 */
class Model_security extends MY_Model{
	public $table_name = "";

	public function __construct(){
		parent::__construct();
	}

	function is_synchronization_authentic($server_SN, $store_SN){
		$query_check_server = "select * from store where serial_number=? limit 1 ";
		$param1 = array (
			$server_SN 
		);
		
		$result = $this -> execute_query($query_check_server, $param1) -> row();
		if(isset($result)){
			$query_check_store = "select * from store where serial_number=? limit 1 ";
			$param2 = array (
				$store_SN 
			);
			$result = $this -> execute_query($query_check_store, $param2) -> row();
			if(isset($result)){
				return TRUE;
			}
		}
		return FALSE;
	}
}
