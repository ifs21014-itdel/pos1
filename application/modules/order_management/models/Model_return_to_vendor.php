<?php

/**
 * @author Rizal.Gurning
 */
class Model_return_to_vendor extends MY_Model {
	
	public $table_name = "returned_to_vendor";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get_rtv_with_pagination($page, $rows, $filterByName){
		$queryStruct = array(
			"select" => " rtv.*, v.code vendor_code, v.name vendor_name, ku.username username",
			"from" => " returned_to_vendor rtv
						join vendor v on v.id = rtv.vendor_id
						join kds_user ku on rtv.created_by = ku.id",
			"where" => "",
			"order_by" => " id asc "
		);
		if (!empty($filterByName)) {
			$queryStruct['where'] .= " rtv.reference ilike '%$filterByName%' or rtv.vendor_id ilike '%$filterByName%'";
		}
		$param = array();
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}
	
	function add_rtv($reference, $vendor_id, $description){
		$data = array(
			"reference" => $reference,
			"vendor_id" => $vendor_id,
			"description" => $description,
			"created_by" => Authority::getUserId()
		);
		return $this -> insert($data);
	}

	function update_rtv($id, $reference, $vendor_id, $description){
		$data = array(
			"reference" => $reference,
			"vendor_id" => $vendor_id,
			"description" => $description
		);
		$where = array(
			"id" => $id
		);
		return $this -> update($data, $where);
	}
	
	function update_rtv_final($id, $status){
		$data = array(
			"status" => $status	
		);
		$where = array(
			"id" => $id
		);
		return $this -> update($data, $where);
	}
	
	function delete_rtv($ids){
		return $this -> deletes($ids);
	}
	
	function select_by_id($id) {
		$query = "
		select rtv.*, v.code vendor_code, v.name vendor_name, ku.username username
		from returned_to_vendor rtv
		join vendor v on v.id = rtv.vendor_id
		join kds_user ku on rtv.created_by = ku.id
		where rtv.id=$id
		";
		return $this->db->query($query)->row();
	}
}