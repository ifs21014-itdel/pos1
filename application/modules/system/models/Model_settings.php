<?php
/**
 * Model_settings
 * 
 * @author Rizal Gurning
 */
class Model_settings extends MY_Model{
	public $table_name = "settings";

	public function __construct(){
		parent::__construct();
	}

	function get_setting_value($key){
		$query = "select value from settings where key=? limit 1 ";
		$param = array (
			$key 
		);
		
		$result = $this -> execute_query($query, $param) -> row();
		$value = "";
		if(isset($result)){
			$value = $result -> value;
		}
		return $value;
	}
	
	function get_id_sync_master(){
		return $this->get_setting_value("ID_SYNC_MASTER");
	}
	
	function get_id_sync_transaction(){
		return $this->get_setting_value("ID_SYNC_TRANSACTION");
	}

	function update_id_sync_master($last_id_sync_master){
		$this->update_setting_value("ID_SYNC_MASTER", $last_id_sync_master);
	}
	
	function update_id_sync_transaction($id_sync_transaction){
		$this->update_setting_value("ID_SYNC_TRANSACTION", $id_sync_transaction);
	}
	
	function update_setting_value($key, $value){
		$data = array (
			"value" => $value 
		);
		$where = array (
			"key" => $key 
		);
		return $this -> update($data, $where);
	}
        
        function get_store_code(){
		$q = "SELECT value FROM settings WHERE key='STORE_CODE'";
		$result = $this->execute_query($q)->result_array();
		return $result[0]['value'];
	}
	
	function get_store_name(){
		$q = "SELECT value FROM settings WHERE key='STORE_NAME'";
		$result = $this->execute_query($q)->result_array();
		return $result[0]['value'];
	}
	
	function get_store_id(){
		$q = "SELECT value FROM settings WHERE key='STORE_ID'";
		$result = $this->execute_query($q)->result_array();
		return $result[0]['value'];
	}
        
        function getAll(){
		return $this->db->query("SELECT key, value FROM settings")->result_array();
	}
}
