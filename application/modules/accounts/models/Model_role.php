<?php
/**
 * @author Rizal Gurning
 */
class Model_role extends MY_Model {

	public $table_name = "kds_role";
	
    public function __construct() {
        parent::__construct();
    }

    function get_roles_with_pagination($page, $rows, $searchCriteriaByName){
    	$queryStruct = array(
    		"select" => " id, name, case when active='f' then 'false' else 'true' end as active ",
    		"from" => " kds_role ",
    		"where" => ""
    	);
    	if (!empty($searchCriteriaByName)) {
    		$queryStruct['where'] .= " name ilike '%$searchCriteriaByName%' ";
    	}
    	$param = array();
    	return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
    }
    
    function add_role($role_name){
    	$data = array(
    		"name" => $role_name,
    		"active" => true,
    		"role_type" => "USER_DEFINED"
    	);
    	
    	return $this -> insert($data);
    }
    
    function update_role($role_id, $role_name){
    	$data = array(
    		"name" => $role_name
    	);
    	$where = array(
    		"id" => $role_id
    	);
    	return $this -> update($data, $where);
    }
    
    function delete_role($role_ids){
    	if(is_array($role_ids)){
    		foreach ($role_ids as $role_id){
		    	$where = array(
		    		"id" => $role_id
		    	);
		        $this -> delete($where);
    		}
    	}else{
    		$where = array(
    			"id" => $role_ids
    		);
    		$this -> delete($where);
    	}
    	return true;
    }
    
    function active_deactive_role($role_ids, $isActive){
    	if(is_array($role_ids)){
    		foreach ($role_ids as $role_id){
    			$data = array(
    				"active" => $isActive
    			);
    			$where = array(
    				"id" => $role_id
    			);
    			$this -> update($data, $where);
    		}
    	} else {
    		$data = array(
    			"active" => $isActive
    		);
    		$where = array(
    			"id" => $role_ids
    		);
    		$this -> update($data, $where);
    	}
    	return true;
    }
}
