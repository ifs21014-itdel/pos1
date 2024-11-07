<?php

/**
 * @author Rizal Gurning
 */
class Model_user_role extends MY_Model {

	public $table_name = "kds_user_role";
	
    public function __construct() {
        parent::__construct();
    }

    public function get_roles_mapping_to_user_with_pagination($page, $rows, $filterCriteriaByUserId){
    	$queryStruct = array(
    		"select" => " ur.id, r.name ",
    		"from" => " kds_role r inner join kds_user_role ur on ur.role_id = r.id inner join kds_user u on u.id = ur.user_id ",
    		"where" => " u.id =? "
    	);
    	if ( !isset($filterCriteriaByUserId)) {
    		$filterCriteriaByUserId = -1;
    	}
    	$param = array(
    		$filterCriteriaByUserId
    	);
    	return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
    }
    
    public function get_available_roles_to_user_with_pagination($page, $rows, $filterByUserId, $filterByRoleName){
    	$queryStruct = array(
    		"select" => " r.id, r.name ",
    		"from" => " kds_role r ",
    		"where" => " r.active = true and r.id not in( select ur2.role_id from kds_user_role ur2 where ur2.user_id =? ) "
    	);
    	if ( !isset($filterByUserId)) {
    		$filterByUserId = -1;
    	}
    	$param = array(
    		$filterByUserId
    	);
    	
    	if (!empty($filterByRoleName)) {
    		$queryStruct['where'] .= " and name ilike '%$filterByRoleName%' ";
    	}
    	
    	return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
    }

    function assign_role_to_user($user_id, $role_ids){
    	foreach($role_ids as $key => $role_id){
    		$data = array (
    			"user_id" => $user_id,
    			"role_id" => $role_id
    		);
    		$this -> insert($data);
    	}
    	return true;
    }
    
    function un_assign_role_from_user($user_role_ids){
    	foreach($user_role_ids as $id){
    		$where = array (
    			"id" => $id
    		);
    		$this -> delete($where);
    	}
    	return true;
    }
    
}
