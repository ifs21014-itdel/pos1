<?php

/**
 * @author Rizal.Gurning
 */
class Model_stock_transfer_manifest_item extends MY_Model {
	
	public $table_name = "stock_transfer_manifest_item";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get_stock_transfer_manifest_items_with_pagination($page, $rows, $stock_transfer_manifest_id, $filterByItemCode, $filterByItemSKU){
		$queryStruct = array(
			"select" => " stm.id, i.sku, stm.quantity, stm.stock_transfer_manifest_id, i.name item_name, u.code as uom_code, i.barcode as barcode  ",
			"from"   => " stock_transfer_manifest_item stm
						  join item i on i.id = stm.item_id
						  left join uom u on u.id = i.uom_id ",
			"where"  => " stm.stock_transfer_manifest_id=? ",
			"order_by" => ""
		);
		if (!empty($filterByItemCode)) {
			$queryStruct['where'] .= " barcode ilike '%$filterByItemCode%' ";
		}
		if (!empty($filterByItemSKU)) {
			if (!empty($queryStruct['where'])) {
				$queryStruct['where'] .=" and ";
			}
			$queryStruct['where'] .= " i.sku ilike '%$filterByItemSKU%' ";
		}
		$param = array(
			$stock_transfer_manifest_id
		);
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}
	
	function add_stock_transfer_manifest_item( $stock_transfer_manifest_id, $item_id, $quantity ){
		$data = array(
			"stock_transfer_manifest_id" => $stock_transfer_manifest_id,
			"item_id" => $item_id,
			"quantity" => $quantity
		);
		return $this -> insert($data);
	}
	
	function insert_stock_transfer_manifest_item_batch($data){
		return $this->insert_batch($data);
	}
	
	function update_stock_transfer_manifest_item( $id, $item_id, $quantity ){
		$data = array(
			"item_id" => $item_id,
			"quantity" => $quantity
		);
		$where = array(
			"id" => $id
		);
		return $this -> update($data, $where);
	}
	
	function delete_stock_transfer_manifest_item($ids){
		return $this -> deletes($ids);
	}
	
	function get_stock_transfer_manifest_items($stock_transfer_manifest_id){
		$query = "select i.stock_transfer_manifest_id, i.item_id, i.quantity, i.transaction_id
			from stock_transfer_manifest_item i
			where i.stock_transfer_manifest_id=? ";
		$param = array(
			$stock_transfer_manifest_id
		);
		$result = $this -> execute_query_as_result($query, $param);
		return $result;
	}
	
}

?>