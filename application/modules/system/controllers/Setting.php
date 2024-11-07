<?php
/**
 * @author Rizal Gurning
 */
class Setting extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model ( "system/Model_settings" );
    }

    function index() {
        $this->load->view('accounts/setting/view');
    }
    
    function getAll(){
    	return $this->Model_settings->getAll();
    }
    
}

