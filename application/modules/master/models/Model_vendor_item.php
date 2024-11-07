<?php

/**
 * @author Rizal.Gurning
 */
class Model_vendor_item extends MY_Model {
	
	public $table_name = "vendor_item";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get_vendor_item_with_pagination($page, $rows, $filterByName){
		$queryStruct = array(
				"select" => " vi.*, v.code vendor_code, v.name vendor_name, i.sku sku, i.name item_name, 
							i.barcode barcode, i.retail_price price ",
				"from" => " vendor_item vi
							join vendor v on v.id = vi.vendor_id
							join item i on i.id = vi.item_id",
				"where" => "",
				"order_by" => " id asc "
		);
		if (!empty($filterByName)) {
			$queryStruct['where'] .= " v.code ilike '%$filterByName%' or v.name ilike '%$filterByName%' ";
		}
		$param = array();
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}
	
	function add_vendor_item( $vendor_id, $item_id, $discount){
		$data = array(
				"vendor_id" => $vendor_id,
				"item_id" => $item_id,
				"discount" => $discount
		);
		return $this -> insert($data);
	}
	
	function update_vendor_item($id, $vendor_id, $item_id, $discount){
		$data = array(
				"vendor_id" => $vendor_id,
				"item_id" => $item_id,
				"discount" => $discount
		);
		$where = array(
				"id" => $id
		);
		return $this -> update($data, $where);
	}
	
	function delete_vendor_item($ids){
		return $this -> deletes($ids);
	}
}

?>