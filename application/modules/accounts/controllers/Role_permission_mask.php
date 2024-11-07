<?php
/**
 * @author Rizal Gurning
 */
class Role_permission_mask extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('accounts/accounts/role_permission_mask/view');
    }
    
    function role_mapping_to_permission_mask_view(){
    	$this->load->view('accounts/accounts/role_permission_mask/view_role_mapping_to_permission_mask');
    }
    
    function permission_mask_mapping_to_role_view(){
    	$this->load->view('accounts/accounts/role_permission_mask/view_permission_mask_mapping_to_role');
    }
    
    function get_permission_masks_mapping_to_role_with_pagination(){
    	$page = $this -> input -> post('page');
    	$rows = $this -> input -> post('rows');
    	$filterByRoleId = $this -> input-> post('role_id');
    	$filterByCodeId = $this -> input-> post('code');
    	$filterByGroupCodeId = $this -> input-> post('group_code');
    
    	$this -> load -> model('model_role_permission_mask');
    	$result = $this -> model_role_permission_mask -> get_permission_masks_mapping_to_role_with_pagination($page, $rows, $filterByRoleId, $filterByCodeId, $filterByGroupCodeId);
    	echo json_encode($result);
    }
    
    function available_permission_mask_to_role_view(){
    	$data = array();
    	$data['role_id'] = $this -> input-> get('role_id');
    	$this -> load -> view('accounts/accounts/role_permission_mask/view_available_permission_mask_to_role', $data);
    }
    
    function get_available_permission_mask_to_role_with_pagination(){
    	$page = $this -> input -> get('page');
    	$rows = $this -> input -> get('rows');
    	$filterByRoleId = $this -> input-> get('role_id');
    	$filterByPermissionCode = $this -> input-> get('code');
    
    	$this -> load -> model('model_role_permission_mask');
    	$result = $this -> model_role_permission_mask -> get_available_permission_mask_to_role_with_pagination($page, $rows, $filterByRoleId, $filterByPermissionCode);
    	echo json_encode($result);
    }
    
    function assign_permission_mask_to_role(){
    	$role_id = $this -> input -> get('role_id');
    	$permission_mask_ids = $this -> input -> get('permission_mask_id');
    	$this -> load -> model('model_role_permission_mask');
    	$isSuccess = $this->model_role_permission_mask->assign_permission_mask_to_role( $role_id, $permission_mask_ids );
    	$this->getMessageResult($isSuccess);
    }
    
    function un_assign_permission_mask_from_role(){
    	$role_permission_mask_ids = $this -> input -> get('id');
    	$this -> load -> model('model_role_permission_mask');
    	$isSuccess = $this -> model_role_permission_mask -> un_assign_permission_mask_from_role($role_permission_mask_ids);
    	$this->getMessageResult($isSuccess);
    }
}
