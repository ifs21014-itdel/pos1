<?php

/**
 * @author Razal.Gurning
 */
class Promotion extends MY_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'model_promotion' );
	}
	
	function index() {
		$this->load->view ( 'master/promotion/index' );
	}
	
	function get_promotion_with_pagination(){
		$page = $this->input->post('page');
		$rows = $this->input->post('rows');
		$filterByName = $this->input->post('name');
		$result = $this->model_promotion->get_promotion_with_pagination($page, $rows, $filterByName);
		echo json_encode($result);
	}
	
	function view_list() {
		$this->load->view ( 'master/promotion/view_list' );
	}

	function input_form() {
		$data['ist_dropD_down'] = [];
		$this->load->view ( 'master/promotion/input_form',$data);
	}
	
	function add_promotion(){
		$item_id = $this -> input -> post('item_id');
		$discount_type = $this -> input -> post('discount_type');
		$value = $this -> input -> post('value');
		$start_date = $this -> input -> post('start_date');
		$end_date = $this -> input -> post('end_date');
		$isSuccess = $this -> model_promotion -> add_promotion( $item_id, $discount_type, $value, $start_date, $end_date);
		$this -> getMessageResult( $isSuccess );
	}
	
	function update_promotion(){
		$id = $this -> input -> post('id');
		$item_id = $this -> input -> post('item_id');
		$discount_type = $this -> input -> post('discount_type');
		$value = $this -> input -> post('value');
		$start_date = $this -> input -> post('start_date');
		$end_date = $this -> input -> post('end_date');
		$isSuccess = $this -> model_promotion -> update_promotion( $id, $item_id, $discount_type, $value, $start_date, $end_date);
		$this -> getMessageResult( $isSuccess );
	}
	
	function delete_promotion(){
		$id = $this -> input -> post('id');
		$isSuccess = $this -> model_promotion -> delete_promotion( $id );
		$this -> getMessageResult( $isSuccess );
	}
	
}
