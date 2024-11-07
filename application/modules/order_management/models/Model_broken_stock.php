<?php

/**
 * @author Rizal.Gurning
 */
class Model_broken_stock extends MY_Model {
	
	public $table_name = "broken_stock";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get_broken_stock_with_pagination($page, $rows, $filterByName){
		$queryStruct = array(
			"select" => "bs.*, date(bs.created_date) as createdate, i.sku sku, i.barcode item_code, i.name item_name, u.code unit_code ",
			"from" => " broken_stock bs
						join item i on i.id = bs.item_id
						left join uom u on u.id = bs.uom_id",
			"where" => "",
			"order_by" => " id desc "
		);
		if (!empty($filterByName)) {
			$queryStruct['where'] .= " ilike '%$filterByName%'";
		}
		$param = array();
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}
	
	function add_broken_stock($item_id, $uom_id, $quantity, $description){
		$this -> load -> model("system/Model_settings");
		$store_source_code = $this ->Model_settings -> get_setting_value("STORE_CODE");
		$this -> load -> model("master/Model_store");
		$store_id = $this -> Model_store -> get_store_id_by_code($store_source_code);
		
		$data = array(
			"item_id" => $item_id,
			"uom_id" => $uom_id,
			"quantity" => $quantity,
			"description" => $description,
			"created_by" => Authority::getUserId(),
			"store_id" => 1 // masih harus diganti jadi $store_id
			
		);
		return $this -> insert($data);
	}

	function update_broken_stock($id, $item_id, $uom_id, $quantity, $description){
		$data = array(
			"item_id" => $item_id,
			"uom_id" => $uom_id,
			"quantity" => $quantity,
			"description" => $description
		);
		$where = array(
			"id" => $id
		);
		return $this -> update($data, $where);
	}
	
	function delete_broken_stock($ids){
		return $this -> deletes($ids);
	}
	
	function select_by_date($start_date) {
		$query = "
		select bs.*, i.sku sku, i.barcode item_code, i.name item_name, u.code unit_code from broken_stock bs
						join item i on i.id = bs.item_id
						left join uom u on u.id = bs.uom_id
						where date(bs.created_date) = '$start_date'
		";
		return $this->db->query($query)->result();
	}
}