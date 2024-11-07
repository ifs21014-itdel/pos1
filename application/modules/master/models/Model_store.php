<?php

/**
 * @author Rizal.Gurning
 */
class Model_store extends MY_Model {
	
	public $table_name = "store";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get() {
	
		$query = " select store.* from store where true";
		$name	 = $this->input->post ( 'name' );
	
		if (! empty ( $name )) {
			$query .= " and (store.code ilike '%$name%' or store.name ilike '%$name%')";
		}
	
		$q = $this->input->post ( 'q' );
	
		if (! empty ( $q )) {
			$query .= " and (store.code ilike '%$q%')";
		}
	
		$query .= " order by id asc ";
		$page = $this->input->post ( 'page' );
		$rows = $this->input->post ( 'rows' );
		$result = array ();
		$data = "";
		if (! empty ( $page ) && ! empty ( $rows )) {
			$offset = ($page - 1) * $rows;
			$result ['total'] = $this->db->query ( $query )->num_rows ();
			$query .= " limit $rows offset $offset";
			$result = array_merge ( $result, array (
				'rows' => $this->db->query ( $query )->result ()
			) );
			$data = json_encode ( $result );
		} else {
			$data = json_encode ( $this->db->query ( $query )->result () );
		}
		return $data;
	}
	
	function get_stores_with_pagination($page, $rows, $filterByName){
		$queryStruct = array(
			"select" => " id, code, name, address, serial_number ",
			"from" => " store s",
			"where" => "",
			"order_by" => " id desc "
		);
		if (!empty($filterByName)) {
			$queryStruct['where'] .= " s.name ilike '%$filterByName%' or s.code ilike '%$filterByName%'";
		}
// 		if (!empty($filterByCode)) {
// 			if (!empty($queryStruct['where'])) {
// 				$queryStruct['where'] .=" and ";
// 			}
// 			$queryStruct['where'] .= " code ilike '%$filterByName%' ";
// 		}
		$param = array();
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}
	
	function add_store($code, $name, $address, $serial_number){
		$data = array(
			"code" => $code,
			"name" => $name,
			"address" => $address,
			"serial_number" => $serial_number
		);
		return $this -> insert($data);
	}
	
	function update_store($id, $code, $name, $address, $serial_number){
		$data = array(
			"code" => $code,
			"name" => $name,
			"address" => $address,
			"serial_number" => $serial_number
		);
		$where = array(
			"id" => $id
		);
		return $this -> update($data, $where);
	}
	
	function delete_store($ids){
		return $this -> deletes($ids);
	}
	
	function get_stores(){
		return $this -> select_all();
	}
        
    function get_store_exclude_self(){
            $query = " select * from store where id != (select value::integer from settings where key ='STORE_ID') ";
            return $this->execute_query_as_result($query, '');
	}
	
	function get_store_id_by_code($code){
		$query = "select id from store where code=? limit 1 ";
		$param = array($code);
		 
		$result = $this -> execute_query($query, $param) ->row();
		$value = "";
		if(isset($result)){
			$value = $result -> id;
		}
		return $value;
	}
	
	function get_store_code_by_serial_number($serial_number){
		$query = "select code from store where serial_number=? limit 1 ";
		$param = array($serial_number);
		$result = $this -> execute_query($query, $param) ->row();
		$value = "";
		if(isset($result)){
			$value = $result -> code;
		}
		return $value;
	}
	
}

?>