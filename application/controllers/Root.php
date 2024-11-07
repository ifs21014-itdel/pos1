<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Root extends MY_Controller {

	public function index(){
		$this -> load -> model("accounts/model_menu_item");
		$data["list_menu_item"] = $this -> model_menu_item -> getMenuItemByCurrentUser();
		$this->load->view('home',$data);
	}
}
