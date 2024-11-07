<?php

/**
 * @author Rizal.Gurning
 */
class Model_uom extends CI_Model {
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get() {
		$query = " select uom.* from uom where true";
		$code_or_name = $this->input->post ( 'code_or_name' );
		if (! empty ( $code_or_name )) {
			$query .= " and (uom.code ilike '%$code_or_name%' or uom.name ilike '%$code_or_name%')";
		}
		$q = $this->input->post ( 'q' );
		
		if (! empty ( $q )) {
			$query .= " and (uom.code ilike '%$q%')";
		}
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
		return $this->db->insert ( 'uom', $data );
	}
	
	function update($data, $where) {
		return $this->db->update ( 'uom',$data, $where );
	}
	
	function delete() {
		if ($this->db->delete('uom', array("id" => $this->input->post('id')))) {
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => $this->db->_error_message()));
		}
	}
	
}

?>