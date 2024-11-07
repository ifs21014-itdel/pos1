<?php
/**
 * @author Rizal Gurning
 */
class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('accounts/accounts/user/view');
    }
    
    function get_data() {
        $this->load->model('model_user');
        echo $this->model_user->get_data();
    }
    
    function get_users_with_pagination(){
    	$page = $this->input->post('page');
    	$rows = $this->input->post('rows');
    	$searchCriteriaByName = $this->input->post('username');

    	$this->load->model('model_user');
    	$result = $this->model_user->get_users_with_pagination($page, $rows, $searchCriteriaByName);
    	echo json_encode($result);
    }

    function add_user_view() {
    	$this->load->view('accounts/accounts/user/add');
    }
    
    function add_user(){
    	$user_access_name = $this -> input -> post('username');
    	$email = $this -> input -> post('email');
    	$first_name = $this -> input -> post('first_name');
    	$last_name = $this -> input -> post('last_name');
    	$password = $this -> input -> post('password');

    	$this->load->model('model_user');
    	$isSuccess = $this -> model_user -> add_user( $user_access_name, $email, $first_name, $last_name, $password );
    	$this -> getMessageResult( $isSuccess );
    }
    
    function edit_user_view() {
    	$this->load->view('accounts/accounts/user/edit');
    }
    
    function update_user(){
    	$user_id = $this -> input -> post('id');
    	$user_access_name = $this -> input -> post('username');
    	$email = $this -> input -> post('email');
    	$first_name = $this -> input -> post('first_name');
    	$last_name = $this -> input -> post('last_name');
    	$password = $this -> input -> post('password');

    	$this->load->model('model_user');
    	$isSuccess = $this -> model_user -> update_user($user_id, $user_access_name, $email, $first_name, $last_name, $password );
    	$this -> getMessageResult( $isSuccess );
    }
    
    function delete_user(){
    	$user_id = $this -> input -> get('id');
    	$this->load->model('model_user');
    	$isSuccess = $this -> model_user -> delete_user( $user_id );
    	$this -> getMessageResult( $isSuccess );
    }
    
    function activate_user(){
    	$user_id = $this -> input -> get('id');
    	$this->load->model('model_user');
    	$isSuccess = $this -> model_user -> active_deactive_user( $user_id, true);
    	$this -> getMessageResult( $isSuccess );
    }
    
    function deactivate_user(){
    	$user_id = $this -> input -> get('id');
    	$this->load->model('model_user');
    	$isSuccess = $this -> model_user -> active_deactive_user( $user_id,false );
    	$this -> getMessageResult( $isSuccess );
    }
    
    function change_password_user_view() {
    	$this->load->view('accounts/accounts/user/changepassword');
    }
}
