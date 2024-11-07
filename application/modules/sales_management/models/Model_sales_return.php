<?php

/**
 * @author Rizal.Gurning
 */
class Model_sales_return extends MY_Model{
	public $table_name = "sales_return";
	
	public function __construct() {
		parent::__construct();
	}
	
	function get_sales_return_with_pagination($page, $rows, $filterByReference){
		$queryStruct = array(
			"select" => " sr.*, sr.created_date::date as createdate, u.code uom_code, s.reference, i.sku sku, i.name item_name ",
			"from" => " sales_return sr 
						join UOM u on sr.uom_id = u.id
						join item i on sr.item_id = i.id
						join sales s on sr.sales_id = s.id",
			"where" => "i. status_sku='ACTIVE' OR i. status_sku='INACTIVE'"
		);
		if (!empty($filterByReference)) {
			$queryStruct['where'] .= " sr.reference ilike '%$filterByReference%' ";
		}
		$param = array();
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}
	
	function add_sales_return($sales_id, $item_id, $uom_id, $quantity, $description, $price){
		$data = array(
				"sales_id" => $sales_id,
				"item_id" => $item_id,
				"uom_id" => $uom_id,
				"quantity" => $quantity,
				"description" => $description,
				"price" => $price,
				"created_by" => Authority::getUserId()
		);
		return $this -> insert($data);
	}
	
	function select_by_date($start_date, $end_date) {
		$query = "
		select sr.*, u.code uom_code, s.reference, i.barcode item_code, i.sku sku, i.name item_name from sales_return sr
			join UOM u on sr.uom_id = u.id
			join item i on sr.item_id = i.id
			join sales s on sr.sales_id = s.id
			where sr.created_date between '$start_date' and '$end_date'
		";
		return $this->db->query($query)->result();
	}
	
}