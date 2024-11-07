<?php
/**
 * @author Rizal Gurning
 */
class Model_role_permission_mask extends MY_Model {

	public $table_name = "kds_role_permission_mask";
	
    public function __construct() {
        parent::__construct();
    }

    public function get_permission_masks_mapping_to_role_with_pagination($page, $rows, $filterByRoleId, $filterByCode, $filterByGroupCode){
    	$queryStruct = array(
    		"select" => " rpm.id, pm.code, pm.description, pm.group_code ",
    		"from" => " kds_role_permission_mask rpm inner join xs_permission_mask pm on pm.id = rpm.permission_mask_id ",
    		"where" => " rpm.role_id =? ",
    		"order_by" => " pm.group_code asc "
    	);
    	if (!empty($filterByCode)) {
    		$queryStruct['where'] .= " and code ilike '%$filterByCode%' ";
    	}
    	if (!empty($filterByGroupCode)) {
    		$queryStruct['where'] .= " and group_code ilike '%$filterByGroupCode%' ";
    	}
    	if ( !isset($filterByRoleId)) {
    		$filterByRoleId = -1;
    	}
    	$param = array(
    		$filterByRoleId
    	);
    	return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
    }
    
    public function get_available_permission_mask_to_role_with_pagination($page, $rows, $filterByRoleId, $filterByPermissionMaskCode){
    	$queryStruct = array(
    		"select" => " pm.id, pm.code, pm.description, pm.code ",
    		"from" => " xs_permission_mask pm ",
    		"where" => " pm.id not in ( select rpm.permission_mask_id from kds_role_permission_mask rpm where rpm.role_id =? ) "
    	);
    	if ( !isset($filterByRoleId)) {
    		$filterByRoleId = -1;
    	}
    	$param = array(
    		$filterByRoleId
    	);
    	if (!empty($filterByRoleName)) {
    		$queryStruct['where'] .= " and pm.code ilike '%$filterByPermissionMaskCode%' ";
    	}
    	return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
    }
    
    function assign_permission_mask_to_role($role_id, $permission_mask_ids){
    	foreach($permission_mask_ids as $key => $permission_mask_id){
    		$data = array (
    			"role_id" => $role_id,
    			"permission_mask_id" => $permission_mask_id
    		);
    		$this -> insert($data);
    	}
    	return true;
    }
    
    function un_assign_permission_mask_from_role($role_permission_mask_ids){
    	foreach($role_permission_mask_ids as $id){
    		$where = array (
    			"id" => $id
    		);
    		$this -> delete($where);
    	}
    	return true;
    }
    
}
