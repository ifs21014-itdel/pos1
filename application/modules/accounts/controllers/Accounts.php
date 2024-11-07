<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Accounts extends MY_Controller{

	function login(){
		if( ! Authority::isUserAuthenticated()){
			
			$this->load->model("system/Model_settings");
			$data['store_name'] = $this->Model_settings->get_store_name();
			
			$this -> load -> view('accounts/accounts/login', $data);
		}else{
			redirect('');
		}
	}

	function index(){
		Authority::validateUserAuthorization(Permission::CASHIER_VIEW_CART);
	}

	function login_auth(){
		if( ! Authority::isUserAuthenticated()){
			$this -> load -> model('model_user');
			$username = $this -> input -> post('username');
			$password = md5($this -> input -> post('password'));
			$where = array (
				"username" => $username, 
				"user_password" => $password 
			);
			$user = $this -> model_user -> select_where($where);
			// print_r($user);
			if( ! empty($user)){
				$this -> session -> set_userdata('id', $user -> id);
				$this -> session -> set_userdata('name', $user -> first_name . " " . $user -> last_name);
				$this -> session -> set_userdata('username', $user -> username);
				$this -> session -> set_userdata('language', $user -> language);
			}
		}
		redirect('');
	}

	function logout(){
		$this -> session -> sess_destroy();
		redirect('');
	}

	function printTableName(){
		$this -> load -> model('model_permission_mask');
		// $this->model_permission_mask->printTableName();
		echo "lang: " . $this -> lang -> line('language_key');
	}

	function lang(){
		$language = $this -> input -> get('l');
		$idiom = "english"; // default
		if($language === "bahasa"){
			$idiom = "bahasa";
		}
		$this -> session -> set_userdata('language', $idiom);
		redirect('');
	}

	function custom_login(){
		$this -> load -> view('accounts/accounts/custom_login');
	}

	function custom_login_auth(){
		$isAllowedToChangeDiscount = false;
		$session_update_discount = array ();
		
		if(Authority::hasPermission(Permission::CASHIER_UPDATE_DISCOUNT)){
			$isAllowedToChangeDiscount = true;
			$session_update_discount = array (
				"username" => Authority::getUserName(), 
				"permission" => Permission::CASHIER_UPDATE_DISCOUNT 
			);
		}else{
			$username = $this -> input -> post('username');
			$password = md5($this -> input -> post('password'));
			$where = array (
				"username" => $username, 
				"user_password" => $password 
			);
			$user = $this -> model_user -> select_where($where);
			
			if( ! empty($user)){
				$this -> load -> model('model_user');
				$granted_permissions = $this -> model_user -> getGrantedPermissionMaskByUser($user -> username);
				$isAllowedToChangeDiscount = is_array($granted_permissions) && isset($granted_permissions[Permission::CASHIER_UPDATE_DISCOUNT]) ? true : false;
				if($isAllowedToChangeDiscount == true){
					$session_update_discount = array (
						"username" => $user -> username, 
						"permission" => Permission::CASHIER_UPDATE_DISCOUNT 
					);
				}
			}
		}
		
		$message = array ();
		if($isAllowedToChangeDiscount == true){
			// keep session to update another discount
			// $this -> session -> set_userdata(Permission::CASHIER_UPDATE_DISCOUNT, $session_update_discount);
			
			$message = array (
				'message' => array (
					"isAllowed" => true, 
					"info" => "", 
					"permissionCode" => "" 
				) 
			);
		}else{
			$message = array (
				'message' => array (
					"isAllowed" => false, 
					"info" => "You do not have permission to change discount. Please try another Account or ask your Admisnistrator.", 
					"permissionCode" => Permission::CASHIER_UPDATE_DISCOUNT 
				) 
			);
		}
		echo json_encode($message);
	}
}