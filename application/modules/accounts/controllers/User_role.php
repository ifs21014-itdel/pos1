<?php
/**
 * @author Rizal Gurning
 */
class User_role extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('accounts/accounts/user_role/view');
    }
    
    function view_user_mapping_to_role(){
    	$this->load->view('accounts/accounts/user_role/view_user_mapping_to_role');
    }
    
    function view_role_mapping_to_user(){
    	$this->load->view('accounts/accounts/user_role/view_role_mapping_to_user');
    }
    
    function get_roles_mapping_to_user_with_pagination(){
    	$page = $this -> input -> post('page');
    	$rows = $this -> input -> post('rows');
    	$filterCriteriaByUserId = $this -> input-> post('user_id');
    
    	$this -> load -> model('model_user_role');
    	$result = $this -> model_user_role -> get_roles_mapping_to_user_with_pagination($page, $rows, $filterCriteriaByUserId);
    	echo json_encode($result);
    }
    
    function view_available_role_to_user(){
    	$data = array();
    	$data['user_id'] = $this -> input-> get('user_id');
    	$this -> load -> view('accounts/accounts/user_role/view_available_role_to_user', $data);
    }
    
    function get_available_roles_to_user_with_pagination(){
    	$page = $this -> input -> get('page');
    	$rows = $this -> input -> get('rows');
    	$filterByUserId = $this -> input-> get('user_id');
    	$filterByRoleName = $this -> input-> get('role_name');
    
    	$this -> load -> model('model_user_role');
    	$result = $this -> model_user_role -> get_available_roles_to_user_with_pagination($page, $rows, $filterByUserId, $filterByRoleName);
    	echo json_encode($result);
    }
    
    function assign_role_to_user(){
    	$user_id = $this -> input -> get('user_id');
    	$role_ids = $this -> input -> get('role_id');
    	$this -> load -> model('model_user_role');
    	$isSuccess = $this -> model_user_role -> assign_role_to_user( $user_id, $role_ids );
    	$this->getMessageResult($isSuccess);
    }
    
    function un_assign_role_from_user(){
    	$user_role_ids = $this -> input -> get('id');
//     	print_r($user_role_ids);exit;
    	
    	$this -> load -> model('model_user_role');
    	$isSuccess = $this -> model_user_role -> un_assign_role_from_user($user_role_ids);
    	$this->getMessageResult($isSuccess);
    }
}
