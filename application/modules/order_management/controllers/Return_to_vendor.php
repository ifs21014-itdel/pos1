<?php

/**
 * @author Razal.Gurning
 */
class Return_to_vendor extends MY_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'Model_return_to_vendor' );
	}
	
	function index() {
		$this->load->view ( 'order_management/return_to_vendor/index' );
	}
	
		
	function get_rtv_with_pagination(){
		$page = $this->input->post('page');
		$rows = $this->input->post('rows');
		$filterByName = $this->input->post('search');
		$result = $this->Model_return_to_vendor->get_rtv_with_pagination($page, $rows, $filterByName);
		echo json_encode($result);
	}
	
	function view_list() {
		$this->load->view ( 'order_management/return_to_vendor/view_list' );
	}

	function input_form() {
		$this->load->view ( 'order_management/return_to_vendor/input_form' );
	}
	
	function add_rtv(){
		$reference = $this -> input -> post('reference');
		$vendor_id = $this -> input -> post('vendor_id');
		$description = $this -> input -> post('description');
		$isSuccess = $this -> Model_return_to_vendor -> add_rtv( $reference, $vendor_id, $description);
		$this -> getMessageResult( $isSuccess );
	}
	
	function update_rtv(){
		$id = $this -> input -> post('id');
		$reference = $this -> input -> post('reference');
		$vendor_id = $this -> input -> post('vendor_id');
		$description = $this -> input -> post('description');
		$isSuccess = $this -> Model_return_to_vendor -> update_rtv( $id, $reference, $vendor_id, $description);
		$this -> getMessageResult( $isSuccess );
	}
	
	function delete_rtv(){
		$id = $this -> input -> post('id');
		$isSuccess = $this -> Model_return_to_vendor -> delete_rtv( $id );
		$this -> getMessageResult( $isSuccess );
	}
	
	// Item Return to Vendor 
	
	function detail_rtv(){
		$this -> load -> view( 'order_management/return_to_vendor/detail_rtv' );
	}
	
	function item_form_view() {
		$this->load->view ( 'order_management/return_to_vendor/item_form_view' );
	}
	
	function get_rtv_items_with_pagination() {
		$page = $this->input->post('page');
		$rows = $this->input->post('rows');
		$returned_to_vendor_id = $this -> input -> post('id');
		$search = $this->input->post('search_item');
		$this->load->model ( 'Model_return_to_vendor_item' );
		$result = $this -> Model_return_to_vendor_item -> get_rtv_items_with_pagination($page, $rows, $search,$returned_to_vendor_id);
		echo json_encode($result);
	}
	
	function add_rtv_item(){
		$returned_to_vendor_id = $this -> input -> post('returned_to_vendor_id');
		$item_id = $this -> input -> post('item_id');
		$quantity = $this -> input -> post('quantity');
		$uom_id = $this -> input -> post('uom_id');
		$this->load->model ( 'Model_return_to_vendor_item' );
		$isSuccess = $this -> Model_return_to_vendor_item -> add_rtv_item( $returned_to_vendor_id, $quantity, $item_id, $uom_id);
		$this -> getMessageResult( $isSuccess );
	}
	
	function update_rtv_item(){
		$id = $this -> input -> post('id');
		$returned_to_vendor_id = $this -> input -> post('returned_to_vendor_id');
		$item_id = $this -> input -> post('item_id');
		$quantity = $this -> input -> post('quantity');
		$uom_id = $this -> input -> post('uom_id');
		$this->load->model ( 'Model_return_to_vendor_item' );
		
		$this->load->model ( 'Model_return_to_vendor_item' );
		$isSuccess = $this -> Model_return_to_vendor_item -> update_rtv_item( $id, $returned_to_vendor_id, $quantity, $item_id, $uom_id);
		$this -> getMessageResult( $isSuccess );
	}
	
	function delete_rtv_item(){
		$id = $this -> input -> post('id');
		$this->load->model ( 'Model_return_to_vendor_item' );
		$isSuccess = $this -> Model_return_to_vendor_item -> delete_rtv_item( $id );
		$this -> getMessageResult( $isSuccess );
	}
	
	function prints($id){
		$this->load->model ( 'Model_return_to_vendor_item' );
		$data['rtv'] = $this->Model_return_to_vendor->select_by_id($id);
		$data['item'] = $this->Model_return_to_vendor_item->select_item_by_rvi_id($id);
		$this->load->view('order_management/return_to_vendor/print',$data);
	}
	
	function rtv_final(){
		$id = $this -> input -> post('id');
		$status = 't';
		$isSuccess = $this->Model_return_to_vendor->update_rtv_final($id, $status);
		$this -> getMessageResult( $isSuccess );
	}
}
