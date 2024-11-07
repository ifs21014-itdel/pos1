<?php

/**
 * Sales Per Cashier
 * 
 * @author Razal.Gurning
 */
class Sales_percashier extends MY_Controller {
	
	public function __construct() {
		parent::__construct ();
	}
	
	function index() {
		$this->load->view ( 'report/sales_percashier/index' );
	}
	
	function get_sales_percashier_with_pagination(){
		$page = $this->input->post('page');
		$rows = $this->input->post('rows');
		$this->load->model("report/Model_sales_percashier");
		$result = $this->Model_sales_percashier->get_sales_percashier_with_pagination($page, $rows);
		echo json_encode($result);
	}
	
}
