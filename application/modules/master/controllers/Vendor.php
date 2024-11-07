<?php

/**
 * @author Razal.Gurning
 */
class Vendor extends MY_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'model_vendor' );
	}
	
	function index() {
		$this->load->view ( 'master/vendor/index' );
	}
	
	function get_data() {
		$this->model_vendor->get_data ();
	}
	
	function get_vendor_with_pagination(){
		$page = $this->input->post('page');
		$rows = $this->input->post('rows');
		$filterByName = $this->input->post('search');
		$result = $this->model_vendor->get_vendor_with_pagination($page, $rows, $filterByName);
		echo json_encode($result);
	}
	
	function view_list() {
		$this->load->view ( 'master/vendor/view_list' );
	}

	function input_form() {
		$this->load->view ( 'master/vendor/input_form' );
	}
	
	function add_vendor(){
		$code = $this -> input -> post('code');
		$name = $this -> input -> post('name');
		$npwp = $this -> input -> post('npwp');
		$phone_number = $this -> input -> post('phone_number');
		$contact_name = $this -> input -> post('contact_name');
		$contact_number = $this -> input -> post('contact_number');
		$discount = $this -> input -> post('discount');
		$discount_promotion = $this -> input -> post('discount_promotion');
		$address = $this -> input -> post('address');
		$term_of_payment = $this -> input -> post('term_of_payment');
		$pkp = $this -> input -> post('pkp');
		$isSuccess = $this -> model_vendor -> add_vendor($code, $name, $npwp, $phone_number, 
				$contact_name, $contact_number, $discount, $discount_promotion, $address, 
				$term_of_payment, $pkp);
		$this -> getMessageResult( $isSuccess );
	}
	
	function update_vendor(){
		$id = $this -> input -> post('id');
		$code = $this -> input -> post('code');
		$name = $this -> input -> post('name');
		$npwp = $this -> input -> post('npwp');
		$phone_number = $this -> input -> post('phone_number');
		$contact_name = $this -> input -> post('contact_name');
		$contact_number = $this -> input -> post('contact_number');
		$discount = $this -> input -> post('discount');
		$discount_promotion = $this -> input -> post('discount_promotion');
		$address = $this -> input -> post('address');
		$term_of_payment = $this -> input -> post('term_of_payment');
		$pkp = $this -> input -> post('pkp');
		$isSuccess = $this -> model_vendor -> update_vendor( $id, $code, $name, $npwp, $phone_number, 
				$contact_name, $contact_number, $discount, $discount_promotion, $address, 
				$term_of_payment, $pkp);
		$this -> getMessageResult( $isSuccess );
	}
	
	function delete_vendor(){
		$id = $this -> input -> post('id');
		$isSuccess = $this -> model_vendor -> delete_vendor( $id );
		$this -> getMessageResult( $isSuccess );
	}
	
}
