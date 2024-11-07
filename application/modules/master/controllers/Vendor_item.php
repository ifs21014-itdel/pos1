<?php

/**
 * Controller vendor_item
 *
 * @author Razal.Gurning
 */
class Vendor_item extends MY_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'model_vendor_item' );
	}
	
	function index() {
		$this->load->view ( 'master/vendor_item/index' );
	}
	
	
	function get_vendor_item_with_pagination(){
		$page = $this->input->post('page');
		$rows = $this->input->post('rows');
		$filterByName = $this->input->post('search');
		$result = $this->model_vendor_item->get_vendor_item_with_pagination($page, $rows, $filterByName);
		echo json_encode($result);
	}
	
	function view_list() {
		$this->load->view ( 'master/vendor_item/view_list' );
	}
	
	function input_form() {
		$this->load->view ( 'master/vendor_item/input_form' );
	}
	
	function add_vendor_item(){
		$vendor_id = $this -> input -> post('vendor_id');
		$item_id = $this -> input -> post('item_id');
		$discount = $this -> input -> post('discount');
		$isSuccess = $this -> model_vendor_item -> add_vendor_item( $vendor_id, $item_id, $discount);
		$this -> getMessageResult( $isSuccess );
	}
	
	function update_vendor_item(){
		$id = $this -> input -> post('id');
		$vendor_id = $this -> input -> post('vendor_id');
		$item_id = $this -> input -> post('item_id');
		$discount = $this -> input -> post('discount');
		$isSuccess = $this -> model_vendor_item -> update_vendor_item( $id, $vendor_id, $item_id, $discount);
		$this -> getMessageResult( $isSuccess );
	}
	
	function delete_vendor_item(){
		$id = $this -> input -> post('id');
		$isSuccess = $this -> model_vendor_item -> delete_vendor_item( $id );
		$this -> getMessageResult( $isSuccess );
	}
	
}
