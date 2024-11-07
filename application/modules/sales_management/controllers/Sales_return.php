<?php

/**
 * @author Rizal.Gurning
 */
class Sales_return extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model ( 'Model_sales_return' );
	}

	function Index(){
		$this -> load -> view('sales_management/sales_return/view');
	}
	
	function sales_view(){
		$this -> load -> view('sales_management/sales_return/view_sales');
	}
	function input_form() {
		$this->load->view ( 'sales_management/sales_return/input_form' );
	}
	
	function add_sales_return(){
		$sales_id = $this -> input -> post('sales_id');
		$item_id = $this -> input -> post('item_id');
		
		$quantity = $this -> input -> post('quantity');
		$description = $this->input -> post('description');
		$price = $this -> input -> post('price');
		$this->load->model('master/Model_item');
                $uom_id = $this -> Model_item -> get_uom_id_by_id($item_id);
		$this->load->model('sales_management/Model_sales_return');
		$isSuccess = $this -> Model_sales_return -> add_sales_return($sales_id, $item_id, $uom_id, $quantity, $description, $price);
		$this -> getMessageResult( $isSuccess );
	}
	
	function get_sales_return_with_pagination(){
		$page = $this->input->post('page');
		$rows = $this->input->post('rows');
		$filterByReference = $this->input->post('reference');
	
		$this->load->model('sales_management/Model_sales_return');
		$result = $this->Model_sales_return->get_sales_return_with_pagination($page, $rows, $filterByReference);
		echo json_encode($result);
	}
	
	function print_form(){
		$this->load->view( 'sales_management/sales_return/print_form' );
	}
	
	function prints($start_date, $end_date){
		$data['start_date']= $start_date;
		$data['end_date'] = $end_date;
		$data['item'] = $this->Model_sales_return->select_by_date($start_date, $end_date);
		$this->load->view( 'sales_management/sales_return/print', $data );
	}
}
