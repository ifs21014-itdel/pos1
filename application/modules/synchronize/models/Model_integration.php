<?php

/**
 * @author Rizal.Gurning
 */
class Model_integration extends MY_Model {
	public $table_name = "sales_datail";
	public function __construct() {
		parent::__construct ();
	}
	
	function regMatchDate($date){
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)){
			return true;
		}else{
			return false;
		}
	}
	
	function backupTable($table, $where, $order) {
		$data = array ();
		$query = "SELECT * FROM $table";
		if (! empty ( $where )) {
			$query .= " WHERE " . $where;
		}
		if (! empty ( $order )) {
			$query .= " ORDER BY " . $order;
		}
		$result = $this->db->query ( $query );
		$resultReturn = $result->result_array ();
		
		foreach ( $resultReturn as $value ) {
			$sql = "INSERT INTO $table VALUES ('";
			$sql .= utf8_decode ( implode ( "','", $value ) );
			$sql .= "');";
			$sql = str_replace ( "''", "NULL", $sql );
			$data [] = $sql;
		}
		return $data;
	}
	
	function backup_stock_item() {
		$data = array ();
		$query = "SELECT * FROM stock_item";
		$result = $this->db->query ( $query );
		$resultReturn = $result->result_array ();
		foreach ( $resultReturn as $value ) {
			$sql = "update stock_item set stock = '".$value['stock']."' where item_id = '".$value['item_id']."' and store_id='".$value['store_id']."';";
			array_push($data, $sql);
		}
		return $data;
	}
	
	function backup_stock_transfer_manifest_receive() {
		$data = array ();
		$query = "SELECT id, received_by, received_date, is_synchronized_received FROM stock_transfer_manifest "
                        . "where store_destination_id = (select value::integer from settings where key='STORE_ID') and status=3"
                        . "and is_synchronized_received = false and received_by is not null and received_date is not null;";
		$result = $this->db->query ( $query );
		$resultReturn = $result->result_array();
		foreach ( $resultReturn as $value ) {
			$sql = "update stock_transfer_manifest set status=3, received_by = '".$value['received_by']."', received_date='".$value['received_date']."', is_synchronized_received='t' ";
			$sql .= " where id = '".$value['id']."';";
			array_push($data, $sql);
		}
		return $data;
	}
	
	function backup_sales_return(){
		$data = array ();
		$query = "SELECT * FROM sales_return;";
		$result = $this->db->query ( $query );
		$resultReturn = $result->result_array ();
		foreach ( $resultReturn as $value ) {
			$sql = "INSERT INTO sales_return VALUES ('";
			$sql .= utf8_decode ( implode ( "','", $value ) );
			$sql .= "');";
			$sql = str_replace ( "''", "NULL", $sql );
			$data [] = $sql;
		}
		return $data;
	}
	
	
	function testSQL(){
		$result = $this->get_uploaded_all_data();
		return $result;
	}
	
	function get_uploaded_all_data() {
		$datas = array ();
		$query_starting_point = "select table_name,last_id,case when target_all_data='t' then 'TRUE' else 'FALSE' end as target_all_data from synchronize order by id asc";
		$result_starting_point = $this->db->query ( $query_starting_point )->result_array ();
		foreach ( $result_starting_point as $row ) {
			$target_all_data = $row ['target_all_data'];
			$last_id = $row ['last_id'];
			$table_name = $row ['table_name'];
			$where_clause = "";
			$data = array();
			if($table_name == "stock_transfer_manifest"){
				$data = $this->backup_stock_transfer_manifest_receive();
			}else if($table_name == "stock_item"){
				$data = $this->backup_stock_item();
			}else{
				if ($target_all_data == false || $target_all_data == 'FALSE') {
					$where_clause = " id > " . $last_id;
				}
				$data = $this->backupTable( $table_name, $where_clause, '1' );
			}
			$datas = array_merge ( $datas, $data );
		}
		return $datas;
	}
	function update_synchronize_table() {
		$datas = array ();
		$query_starting_point = "select table_name,last_id,case when target_all_data='t' then 'TRUE' else 'FALSE' end as target_all_data from synchronize order by id";
		$result_starting_point = $this->db->query ( $query_starting_point )->result_array ();
		foreach ( $result_starting_point as $row ) {
			$last_id = $row ['last_id'];
			$table_name = $row ['table_name'];
			$target_all_data = $row ['target_all_data'];
                        //var_dump($target_all_data);
			$query_update = "update synchronize set last_id = COALESCE((select max(id) from $table_name),0) ,last_synchronized_date = now() where table_name = '$table_name'";
			if ( $target_all_data === 'TRUE') {
				$query_update= "update synchronize set last_synchronized_date = now() where table_name = '$table_name'";
			}
                        //var_dump($target_all_data);
			$this->execute_query ( $query_update );
			
			//update table transaksi jika upload berhasil seperti table "STM Receive"
			if($table_name = "stock_transfer_manifest"){
				$sql_update_stm = "update stock_transfer_manifest set is_synchronized_received =true ".
				" where is_synchronized_received = false and received_by is not null and received_date is not null; ";
				$this->execute_query ( $sql_update_stm );
			}
		}
                //exit;
		return true;
	}
}

?>