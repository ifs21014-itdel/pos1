<?php
/**
 * @author Rizal Gurning
 */
class Model_user extends MY_Model {

	public $table_name = "kds_user";
	
    public function __construct() {
        parent::__construct();
    }
    
    function get_data() {
        $query = "
            select u.*
            from kds_user u
            where u.active=true
            ";
        $q = $this->input->post('q');
        if(!empty($q)){
            $query .= " and (u.first_name ilike '%$q%' or u.last_name ilike '%$q%' or u.username ilike '%$q%')";
        }
    
        $query .= " order by u.id desc ";
    
        //echo $query;
    
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }
    
    public function isUserHasPermissionMask($permissionMask){
    	$query = " select count(1) as total from xs_permission_mask pm
				inner join kds_role_permission_mask rpm on rpm.permission_mask_id = pm.id
				inner join kds_user_role ur on ur.role_id = rpm.role_id
				inner join kds_user u on u.id = ur.user_id
				where pm.code =? and u.username =? ";
		
		$param = array (
			$permissionMask,
			Authority::getUserName()
		);
		$result =  $this -> execute_query($query, $param);
		$row = $result->row();
		if($row->total > 0){
			return true;
		}else{
			return false;
		}
    }
    
    public function getGrantedPermissionMaskCurrentUser(){
    	return $this->getGrantedPermissionMaskByUser(Authority::getUserName());
    }
    
    public function getGrantedPermissionMaskByUser($userName){
    	$query = " select pm.code from xs_permission_mask pm
				inner join kds_role_permission_mask rpm on rpm.permission_mask_id = pm.id
				inner join kds_user_role ur on ur.role_id = rpm.role_id
				inner join kds_user u on u.id = ur.user_id
				where u.username =? ";
		$param = array (
			$userName
		);
		$result = $this -> execute_query($query, $param) -> result();
		$permissions = array();
		foreach ($result as $row) {
			$permissions[$row->code] = $row->code;
		}
		return $permissions;
    }
    
    function get_users_with_pagination($page, $rows, $searchCriteriaByName){
    	$queryStruct = array(
    		"select" => " id, username, email, first_name, case when last_name = null then '' else last_name end as last_name, case when active='f' then 'false' else 'true' end as active ",
    		"from" => " kds_user ",
    		"where" => ""
    	);
    	if (!empty($searchCriteriaByName)) {
    		$queryStruct['where'] .= " username ilike '%$searchCriteriaByName%' ";
    	}
    	$param = array();
    	return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
    }
    
    
    function add_user($user_access_name, $email, $first_name, $last_name, $password){
    	$data = array(
    		"active" => true,
    		"email" => $email,
    		"username" => $user_access_name,
    		"first_name" => $first_name,
    		"last_name" => $last_name,
    		"user_password" => md5($password),
    		"password_reset" => false
    	);
    	 
    	return $this -> insert($data);
    }
    
    function update_user($user_id, $user_access_name, $email, $first_name, $last_name, $password){
    	$data = array(
    		"username" => $user_access_name,
    		"email" => $email,
    		"first_name" => $first_name,
    		"last_name" => $last_name,
    		"user_password" => md5($password)
    	);
    	$where = array(
    		"id" => $user_id
    	);
    	return $this -> update($data, $where);
    }
    
    function delete_user($user_ids){
    	if(is_array($user_ids)){
    		foreach ($user_ids as $user_id){
    			$where = array(
    				"id" => $user_id
    			);
    			$this -> delete($where);
    		}
    	} else {
    		$where = array(
    			"id" => $user_ids
    		);
    		$this -> delete($where);
    	}
    	return true;
    }
    
    function active_deactive_user($user_ids, $isActive){
    	if(is_array($user_ids)){
    		foreach ($user_ids as $user_id){
    			$data = array(
    				"active" => $isActive
    			);
    			$where = array(
    				"id" => $user_id
    			);
    			$this -> update($data, $where);
    		}
    	} else {
    		$data = array(
    				"active" => $isActive
    		);
    		$where = array(
    			"id" => $user_ids
    		);
    		$this -> update($data, $where);
    	}
    	return true;
    }
    
}
