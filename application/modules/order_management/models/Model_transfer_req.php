<?php

/**
 * Model transfer_req
 *
 * @author Rizal.Gurning
 */
class Model_transfer_req extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function get() {
		
		$query = "select * from ts_request 
        	where true
        ";
// 		echo $query;
		
 		$no_ts	 = $this->input->post ( 'no_ts' );
		
		if (! empty ( $no_ts )) {
			$query .= " and (ts.no_ts ilike '%$no_ts%')";
		}
		
		$q = $this->input->post ( 'q' );
		
		if (! empty ( $q )) {
			$query .= " and (ts.id ilike '%$q%' or ts.no_ts ilike '%$q%')";
		}
		
		$query .= " order by id asc ";
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
		return $this->db->insert ( 'transfer_req', $data );
	}
	function update($data, $where) {
		return $this->db->update ( 'transfer_req',$data, $where );
	}
	
	function delete() {
		if ($this->db->delete('transfer_req', array("id" => $this->input->post('id')))) {
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('msg' => $this->db->_error_message()));
		}
	}
	
	// detail item for PO
	function get_item(){
	
		$ts_id = $this->input->post('id');
		if (empty($ts_id)) {
			$ts_id = 0;
		}
	
		$query = "select * from ts_request_item
				where true";
	
		// 		$po_number = $this->input->post('id');
		// 		if (!empty($po_number)) {
		// 			$query .= " and d_po.id ilike '%$po_number%'";
		// 		}
	
// 		 		echo $query;
		$q = $this->input->post ( 'q' );
	
		if (! empty ( $q )) {
			$query .= " and (detail_po.id ilike '%$q%')";
		}
	
		$query .= " order by id asc ";
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
	
	function item_insert($data) {
		return $this->db->insert ( 'ts_request_item', $data );
	}
	function item_update($data, $where) {
		return $this->db->update ( 'ts_request_item', $data, $where );
	}
	function item_delete() {
		if ($this->db->delete ( 'ts_request_item', array (
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