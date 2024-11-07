<?php
/**
 * @author Rizal Gurning
 */
class Role extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_role');
    }

    function index() {
        $this->load->view('accounts/accounts/role/view');
    }

    function get_roles_with_pagination(){
    	$page = $this->input->post('page');
    	$rows = $this->input->post('rows');
    	$searchCriteriaByName = $this->input->post('name');

    	$result = $this->model_role->get_roles_with_pagination($page, $rows, $searchCriteriaByName);
    	echo json_encode($result);
    }
    
    function add_role_view() {
    	$this->load->view('accounts/accounts/role/add');
    }
    
    function add_role(){
    	$name = $this -> input -> post('name');
    	$active = $this -> input -> post('active');
    	$isSuccess = $this -> model_role -> add_role( $name, $active );
    	$this -> getMessageResult( $isSuccess );
    }
    
    function edit_role_view() {
    	$this->load->view('accounts/accounts/role/edit');
    }
    
    function update_role(){
    	$role_id = $this -> input -> post('id');
    	$role_name = $this -> input -> post('name');
    	$isSuccess = $this -> model_role -> update_role( $role_id, $role_name );
    	$this -> getMessageResult( $isSuccess );
    }
    
    function delete_role(){
    	$role_id = $this -> input -> get('id');
    	$isSuccess = $this -> model_role -> delete_role( $role_id );
    	$this -> getMessageResult( $isSuccess );
    }
    
    function activate_role(){
    	$role_ids = $this -> input -> get('id');
    	$isSuccess = $this -> model_role -> active_deactive_role( $role_ids, true);
    	$this -> getMessageResult( $isSuccess );
    }
    
    function deactivate_role(){
    	$role_ids = $this -> input -> get('id');
    	$isSuccess = $this -> model_role -> active_deactive_role( $role_ids,false );
    	$this -> getMessageResult( $isSuccess );
    }
    
}
