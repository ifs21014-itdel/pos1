<?php

/**
 * Model po
 *
 * @author Rizal.Gurning
 */
class Model_supplier extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function select_by_id($id){
		$query = "select s.id, s.supplier_id, s.nama, s.kontak_nama, s.diskon, s.diskon_promo, s.alamat, s.keterangan, s.term_of_payment, s.pkp, s.npwp, 
			s.nomor_kontak, s.telepon from supplier s where true 
        ";
		return $this->db->query($query)->row();
		// 		print_r($query);exit();
	}
	function get() {
		$query = "select * from vendor s where true 
        ";
		
		
		
		$q = $this->input->post ( 'q' );
		
		if (! empty ( $q )) {
			$query .= " and (s.code ilike '%$q%' or s.name ilike '%$q%')";
		}
// 		echo $query;
		$query .= " order by id desc ";
		$page = $this->input->post ( 'page' );
		$rows = $this->input->post ( 'rows' );
		$result = array ();
		$data = "";
		if (! empty ( $page ) && ! empty ( $rows )) {
			$offset = ($page - 1) * $rows;
			$result ['total'] = $this->db->query ( $query )->num_rows ();
			$query .= " limit $rows offset $offset";
			$result = array_merge ( $result, array (
					'rows' => $this->db->query ( $query )->result () 
			) );
			$data = json_encode ( $result );
		} else {
			$data = json_encode ( $this->db->query ( $query )->result () );
		}
		return $data;
	}
	function insert($data) {
		return $this->db->insert ( 'supplier', $data );
	}
	function update($data, $where) {
		return $this->db->update ( 'supplier', $data, $where );
	}
	function delete() {
		if ($this->db->delete ( 'supplier', array (
				"id" => $this->input->post ( 'id' ) 
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

?>