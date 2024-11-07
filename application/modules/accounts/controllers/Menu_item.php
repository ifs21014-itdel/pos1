<?php
/**
 * @author Rizal Gurning
 */
class Menu_item extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_menu_item');
    }

    function index() {
        $this->load->view('accounts/accounts/menu_item/view');
    }

    function get_menu_items_with_pagination(){
    	$page = $this->input->post('page');
    	$rows = $this->input->post('rows');
    	$filterByName = $this->input->post('name'); 
    	$filterByCode = $this->input->post('code');

    	$result = $this->model_menu_item->get_menu_items_with_pagination($page, $rows, $filterByName, $filterByCode);
    	echo json_encode($result);
    }
}
