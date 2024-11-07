<?php

/**
 * @author Razal.Gurning
 */
class Broken_stock extends MY_Controller {

public function __construct() {
		parent::__construct ();
		$this->load->model ( 'Model_broken_stock' );
	}
	
	function index() {
		$this->load->view ( 'order_management/broken_stock/index' );
	}
	
	function get_broken_stock_with_pagination(){
		$page = $this->input->post('page');
		$rows = $this->input->post('rows');
		$filterByName = $this->input->post('search');
		$result = $this->Model_broken_stock->get_broken_stock_with_pagination($page, $rows, $filterByName);
		echo json_encode($result);
	}
	
	function view_list() {
		$this->load->view ( 'order_management/broken_stock/view_list' );
	}

	function input_form() {
		$this->load->view ( 'order_management/broken_stock/input_form' );
	}
	
	function add_broken_stock(){
		$item_id = $this -> input -> post('item_id');
		$uom_id = $this -> input -> post('uom_id');
		$quantity = $this -> input -> post('quantity');
		$description = $this->input -> post('description');
		$isSuccess = $this -> Model_broken_stock -> add_broken_stock($item_id, $uom_id, $quantity, $description);
		$this -> getMessageResult( $isSuccess );
	}
	
	function update_broken_stock(){
		$id = $this -> input -> post('id');
		$item_id = $this -> input -> post('item_id');
		$uom_id = $this -> input -> post('uom_id');
		$quantity = $this -> input -> post('quantity');
		$description = $this->input -> post('description');
		$isSuccess = $this -> Model_broken_stock -> update_broken_stock( $id, $item_id, $uom_id, $quantity, $description);
		$this -> getMessageResult( $isSuccess );
	}
	
	function delete_broken_stock(){
		$id = $this -> input -> post('id');
		$isSuccess = $this -> Model_broken_stock -> delete_broken_stock( $id );
		$this -> getMessageResult( $isSuccess );
	}
	
	function print_form(){
		$this->load->view( 'order_management/broken_stock/print_form' );
	}
	
	function prints($start_date){
		$data['start_date']= $start_date;
                $this->load->model ( 'system/Model_settings' );
                $settings= $this->Model_settings->getAll();
                foreach($settings as $value) {
                    $data['settings'][$value['key']]=$value['value'];
                }
		$data['item'] = $this->Model_broken_stock->select_by_date($start_date);
		$this->load->view( 'order_management/broken_stock/print', $data );
	}

}
