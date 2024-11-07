<?php

/**
 * Controller supplier
 *
 * @author Razal.Gurning
 */
class Supplier extends MX_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'Model_supplier' );
	}
	function index() {
		$this->load->view ( 'master/supplier/index' );
	}
	function get() {
		echo $this->Model_supplier->get();
	}
	function view_list() {
		$this->load->view ( 'master/supplier/view_list' );
	}
	function input_form() {
		$this->load->view ( 'master/supplier/input_form' );
	}
	function save($id) {
		$pkp = $this->input->post ( 'pkp' );
		$pkp2 = ($pkp == 't') ? 'true' : 'false';
		$data = array (
				"supplier_id" => $this->input->post ( 'supplier_id' ),
				"nama" => $this->input->post ( 'nama' ),
				"npwp" => $this->input->post ( 'npwp' ),
				"telepon" => $this->input->post ( 'telepon' ),
				"kontak_nama" => $this->input->post ( 'kontak_nama' ),
				"nomor_kontak" => $this->input->post ( 'nomor_kontak' ),
				"diskon" => $this->input->post ( 'diskon' ),
				"diskon_promo" => $this->input->post ( 'diskon_promo' ),
				"alamat" => $this->input->post ( 'alamat' ),
				"keterangan" => $this->input->post ( 'keterangan' ),
				"term_of_payment" => $this->input->post ( 'term_of_payment' ),
				"pkp" =>$pkp2
				);
		if ($id == 0) {
			// call method insert supplier
			if ($this->Model_supplier->insert ( $data )) {
				echo json_encode ( array (
						'success' => true 
				) );
			} else {
				echo json_encode ( array (
						'msg' => $this->db->_error_message () 
				) );
			}
		} else {
			// call method update supplier
			
			if ($this->Model_supplier->update ( $data, array (
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
	// 		echo json_encode ( array (
	// 				'success' => true 
	// 		) );
	}
	function delete() {
		$this->Model_supplier->delete();
	}
}
