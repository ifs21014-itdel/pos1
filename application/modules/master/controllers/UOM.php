<?php

/**
 * @author Razal.Gurning
 */
class UOM extends MY_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'Model_uom' );
	}
	
	function index() {
		$this->load->view ( 'master/UOM/index' );
	}
	
	function get() {
		echo $this->Model_uom->get();
	}
	
	function view_list() {
		$this->load->view ( 'master/UOM/view_list' );
	}
	
	function input_form() {
		$this->load->view ( 'master/UOM/input_form' );
	}
	
	function save($id) {
		$data = array (
				"code" => $this->input->post ( 'code' ),
				"name" => $this->input->post ( 'name' ),
				);
		if ($id == 0) {
			// call method insert unit
			if ($this->Model_uom->insert ( $data )) {
				echo json_encode ( array (
						'success' => true 
				) );
			} else {
				echo json_encode ( array (
						'msg' => $this->db->_error_message () 
				) );
			}
		} else {
			// call method update unit
			if ($this->Model_uom->update ( $data, array (
					"id" => $id 
			) )) {
				echo json_encode ( array (
						'success' => true 
				) );
			} else {
				echo json_encode ( array (
						'msg' => $this->db->_error_message () 
				) );
			}
		}
	}
	
	function delete() {
		$this->Model_uom->delete();
	}
}
