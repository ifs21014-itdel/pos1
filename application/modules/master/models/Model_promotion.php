<?php

/**
 * @author Rizal.Gurning
 */
class Model_promotion extends MY_Model {
	
	public $table_name = "promotion";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get_promotion_with_pagination($page, $rows, $filterByName){
		$queryStruct = array(
			"select" => "p.*,i.sku sku,i.name item_name, i.barcode barcode, ku.username username",
			"from" => "promotion p
			join item i on p.item_id = i.id
			join kds_user ku on p.created_by = ku.id",
			"where" => "",
			"order_by" => " id asc "
		);
		if (!empty($filterByName)) {
			$queryStruct['where'] .= " i.name ilike '%$filterByName%' or i.sku ilike '%$filterByName%' or i.barcode ilike '%$filterByName%'";
		}
		$param = array();
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}
	
	function add_promotion($item_id, $discount_type, $value, $start_date, $end_date){
		$data = array(
			"item_id" => $item_id,
			"discount_type" => $discount_type,
			"value" => $value,
			"start_date" => $start_date,
			"end_date" => $end_date,
			"created_by" => Authority::getUserId()
		);
		return $this -> insert($data);
	}

	function update_promotion($id, $item_id, $discount_type, $value, $start_date, $end_date){
		$data = array(
			"item_id" => $item_id,
			"discount_type" => $discount_type,
			"value" => $value,
			"start_date" => $start_date,
			"end_date" => $end_date,
			"updated_date" => "now()"
		);
		$where = array(
			"id" => $id
		);
		return $this -> update($data, $where);
	}
	
	function delete_promotion($ids){
		return $this -> deletes($ids);
	}
	
}