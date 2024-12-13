<?php

class Model_category extends MY_Model {
	
	public $table_name = "category";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get_data($level) {
		$query = " select * from category where true";
		if($level != 0){
			$query .= " and (level=$level)";
		}
		$query .= " order by id asc ";
		$data = json_encode($this->db->query($query)->result());
		echo $data;
	}
	
	function get_data_by_id($id) {
	    $query = " select * from category where id = ".$id;
	    $data = json_encode($this->db->query($query)->result());
	    echo $data;
	}
	
	function get_categories_with_pagination($page, $rows, $filterByName, $filterByLevel){
		$queryStruct = array(
			"select" => " id, name, level, parent_id ",
			"from" => " category ",
			"where" => "",
			"order_by" => " id asc "
		);
		if (!empty($filterByName)) {
			$queryStruct['where'] .= " name ilike '%$filterByName%' ";
		}
		if (!empty($filterByLevel)) {
			if (!empty($queryStruct['where'])) {
				$queryStruct['where'] .=" and ";
			}
			$queryStruct['where'] .= " level = $filterByLevel ";
		}
		$param = array();
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}
	
	function add_category($name, $level, $parent_id){
		$data = array(
			"name" => $name,
			"level" => $level,
			"parent_id" => $parent_id
		);
		return $this -> insert($data);
	}

	function update_category($id, $name, $level, $parent_id){
		$data = array(
			"name" => $name,
			"level" => $level,
			"parent_id" => $parent_id
		);
		$where = array(
			"id" => $id
		);
		return $this -> update($data, $where);
	}
	
	function delete_category($ids){
		return $this -> deletes($ids);
	}
}