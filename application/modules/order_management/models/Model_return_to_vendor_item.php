<?php

/**
 * @author Rizal.Gurning
 */
class Model_return_to_vendor_item extends MY_Model {
	
	public $table_name = "returned_to_vendor_item";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get_rtv_items_with_pagination($page, $rows, $search, $returned_to_vendor_id){
		$queryStruct = array(
			"select" => " rvi.*, i.sku sku, i.barcode item_code, i.name item_name, u.code unit_code ",
			"from"   => " returned_to_vendor_item rvi
						  join item i on i.id = rvi.item_id
						  left join uom u on u.id = rvi.uom_id ",
			"where"  => " rvi.returned_to_vendor_id= ?",
			"order_by" => "id asc"
		);
		
		//echo $returned_to_vendor_id; 
		if (!empty($search)) {
			$queryStruct['where'] .= " barcode ilike '%$search%' ";
		}
		$param = array(
			$returned_to_vendor_id
		);
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}
	
	function add_rtv_item( $returned_to_vendor_id, $quantity, $item_id, $uom_id ){
		$data = array(
			"returned_to_vendor_id" => $returned_to_vendor_id,
			"quantity" => $quantity,
			"item_id" => $item_id,
			"uom_id" => $uom_id
		);
		return $this -> insert($data);
	}
	
	function update_rtv_item( $id, $returned_to_vendor_id, $quantity, $item_id, $uom_id ){
		$data = array(
			"returned_to_vendor_id" => $returned_to_vendor_id,
			"quantity" => $quantity,
			"item_id" => $item_id,
			"uom_id" => $uom_id
		);
		$where = array(
			"id" => $id
		);
		return $this -> update($data, $where);
	}
	
	function delete_rtv_item($ids){
		return $this -> deletes($ids);
	}
	
	function select_item_by_rvi_id($returned_to_vendor_id) {
		$query = "select rvi.*, i.sku sku, i.barcode item_code, i.name item_name, u.code unit_code
		from returned_to_vendor_item rvi
		join item i on i.id = rvi.item_id
		left join uom u on u.id = rvi.uom_id
		where rvi.returned_to_vendor_id = $returned_to_vendor_id";
		return $this->db->query($query)->result();
	}
}