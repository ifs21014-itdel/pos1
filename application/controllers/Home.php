<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	
	public $languange_source= "";
	
	public function __construct(){
		parent::__construct();
	}
	
    public function index() {
        $this->load->model("accounts/model_menu_item");
        $data["list_menu_item"] = $this->model_menu_item->getMenuItemByCurrentUser();
        $this->load->model("system/Model_settings");
        $data["store_name"]=  $this->Model_settings->get_store_name();
        $this->load->view('home', $data);
    }

}
