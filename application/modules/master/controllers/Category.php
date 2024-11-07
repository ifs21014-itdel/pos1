<?php

/**
 * @author Razal.Gurning
 */
class Category extends MY_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'model_category' );
	}
	
	function index() {
		$this->load->view ( 'master/category/index' );
	}
	
	function get_data($level = 0){
		$this->model_category->get_data($level);
	}
	
	function get_categories_with_pagination(){
		$page = $this->input->post('page');
		$rows = $this->input->post('rows');
		$filterByName = $this->input->post('name');
		$filterByLevel = $this->input->post('level');
		$result = $this->model_category->get_categories_with_pagination($page, $rows, $filterByName, $filterByLevel);
		echo json_encode($result);
	}
	
	function view_list() {
		$this->load->view ( 'master/category/view_list' );
	}

	function input_form() {
		$this->load->view ( 'master/category/input_form' );
	}
	
	function add_category(){
		$name = $this -> input -> post('name');
		$level = $this -> input -> post('level');
		$parent_id = $this -> input -> post('parent_id');
		$isSuccess = $this -> model_category -> add_category( $name, $level, $parent_id);
		$this -> getMessageResult( $isSuccess );
	}
	
	function update_category(){
		$id = $this -> input -> post('id');
		$name = $this -> input -> post('name');
		$level = $this -> input -> post('level');
		$parent_id = $this -> input -> post('parent_id');
		$isSuccess = $this -> model_category -> update_category( $id, $name, $level, $parent_id);
		$this -> getMessageResult( $isSuccess );
	}
	
	function delete_category(){
		$id = $this -> input -> post('id');
		$isSuccess = $this -> model_category -> delete_category( $id );
		$this -> getMessageResult( $isSuccess );
	}

}
