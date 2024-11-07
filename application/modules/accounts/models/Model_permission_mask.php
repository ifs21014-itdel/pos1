<?php
/**
 * @author Rizal Gurning
 */
class Model_permission_mask extends MY_Model {
	
	public $table_name = "xs_permission_mask";
	
    public function __construct() {
        parent::__construct();
    }

    function get_permission_masks_with_pagination($page, $rows, $searchCriteriaByCode, $searchCriteriaByGroupCode){
    	$queryStruct = array(
    		"select" => " id, code, description, group_code ",
    		"from" => " xs_permission_mask ",
    		"where" => "",
    		"order_by" => " code asc, group_code asc "
    	);
    	if (!empty($searchCriteriaByCode)) {
    		$queryStruct['where'] .= " code ilike '%$searchCriteriaByCode%' ";
    	}
    	if (!empty($searchCriteriaByGroupCode)) {
    		if(!empty($queryStruct['where'])){
    			$queryStruct['where'] .= " and ";
    		}
    		$queryStruct['where'] .= " code ilike '%$searchCriteriaByGroupCode%' ";
    	}
    	$param = array();
    	return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
    }
    
}
