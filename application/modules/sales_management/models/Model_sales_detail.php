<?php

/**
 * @author Rizal.Gurning
 */
class Model_sales_detail extends MY_Model{
	public $table_name = "sales_datail";
	
	public function __construct() {
		parent::__construct();
	}
	
	function get_data(){
		$query = " select sales_item.*, i.name item_name, i.uom_id uom from sales_item 
					join item i on item_id = i.id
					where true
					";
		$q = $this->input->post('q');
		if (!empty($q)) {
			$query .= " and (sales_item.sales_id ilike '%$q%')";
		}
		$query .= " order by sales_item.id asc ";
		return $this->db->query($query)->result();
	}
	
	function get_data_by_sales_id($sales_id=""){
		$query = " select si.id as sales_item_id, i.id as item_id, i.name as item_name, si.quantity, i.uom_id uom_id, u.code uom_name,
					si.sub_total_price as price_total
					from sales_item si
					join item i on si.item_id = i.id
					join uom u on i.uom_id = u.id
					where si.sales_id =? 
					";
		$param = array(
				"sales_id" => $sales_id
		);
		$q = $this->input->post('q');
		if (!empty($q)) {
			$query .= " and (i.name ilike '%$q%')";
		}
		$query .= " order by i.name asc ";
		return $this->execute_query_as_result($query, $param);
	}
	
	function get_sales_details_with_pagination($page, $rows, $filterBySalesId, $filterByItemBarcode, $filterByItemName){
		if(! empty($filterBySalesId)){
			$queryStruct = array(
				"select" => " sd.id,i.barcode as item_barcode,i.name as item_name,sd.quantity,sd.discount,
						  sd.sub_total_price,(u.first_name||' '||u.last_name)as discount_update_by,sd.created_date ",
				"from" => " sales_item sd join item i on i.id = sd.item_id left join kds_user u on u.id = sd.discount_update_by ",
				"where" => " sd.sales_id =? "
			);
			if (!empty($filterByItemBarcode)) {
				$queryStruct['where'] .= " i.barcode ilike '%$filterByItemBarcode%' ";
			}
			if (!empty($filterByItemName)) {
				if(!empty($queryStruct['where'])){
					$queryStruct['where'] .= " and ";
				}
				$queryStruct['where'] .= " i.name ilike '%$filterByItemName%' ";
			}
			$param = array(
				$filterBySalesId
			);
			return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
		}else{
			return $this -> get_result_empty_with_pagination();
		}
	}
}

?>