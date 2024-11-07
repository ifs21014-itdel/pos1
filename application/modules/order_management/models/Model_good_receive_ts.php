<?php

/**
 * Model po
 *
 * @author Rizal.Gurning
 */
class Model_good_receive_ts extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function select_by_id($id){
// 		$transfer_stock_code = $this->input->post ( 'transfer_stock_code' );
// 		if (empty($transfer_stock_code)) {
// 			$transfer_stock_code ="";
// 		}
	
		$query = "select ts.*, s1.name store, s2.name dst_store
			from stock_transfer_manifest ts
			join store s1 on s1.id=ts.store_source_id
			join store s2 on s2.id=ts.store_destination_id
			where ts.id=$id";
		
		return $this->db->query($query)->row();
				print_r($query);exit();
	}
	
	function select_item_by_ts_id($ts_id){
		$query = "
                        select i.sku, i.barcode, i.name item_name, i.uom_id, stmi.id, stmi.stock_transfer_manifest_id, stmi.quantity quantity, u.code unit_code from item i
                        join stock_transfer_manifest_item stmi on i.id = stmi.item_id
                        join uom u on i.uom_id = u.id		
			where stmi.stock_transfer_manifest_id = $ts_id";
		return $this->db->query($query)->result();
	}
	
	function get() {
		
// 		$transfer_stock_code = $this->input->post ( 'transfer_stock_code' );
// 		if (empty($transfer_stock_code)) {
// 			$transfer_stock_code ="";
// 		}
// 		$query = "select ts.*, s1.name store, s2.name dst_store
// 			from transfer_stock ts
// 			join store s1 on s1.id=ts.store_id
// 			join store s2 on s2.id=ts.dest_store
// 			where ts.transfer_stock_code='$transfer_stock_code'";
		
		$query = "
        	select ts.*, s1.name store, s2.name dst_store, ku.first_name received_name
			from stock_transfer_manifest ts
			join store s1 on s1.id=ts.store_source_id
			join store s2 on s2.id=ts.store_destination_id
                        LEFT join kds_user ku on ts.received_by = ku.id
			where ts.store_source_id <> (SELECT value::integer FROM settings WHERE key = 'STORE_ID') 
                            AND ts.store_destination_id = (SELECT value::integer FROM settings WHERE key = 'STORE_ID') 
        ";
		$transfer_stock_code = $this->input->post ( 'transfer_stock_code' );
		
		if (! empty ( $transfer_stock_code )) {
			$query .= " and (ts.code ilike '%$transfer_stock_code%')";
		}
		
// 		if (! empty ( $number )) {
			
// 		}
		
		$q = $this->input->post ( 'q' );
		
		if (! empty ( $q )) {
			$query .= " and (ts.code ilike '%$q%')";
		}
		
		$query .= "order by ts.status, ts.id desc"; // error pada offset row
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

	function update($data, $where) {
		if ($this->db->update ( 'stock_transfer_manifest', $data, $where )
		) {
			echo json_encode ( array (
					'success' => true
			) );
		} else {
			echo json_encode ( array (
					'msg' => $this->db->_error_message ()
			) );
		}
	
	}
	// detail item for TS
	function get_item(){
		
		$ts_id = $this->input->post('id');
		if (empty($ts_id)) {
			$ts_id = 0;
		}
		
		$query = "select dts.id, dts.sku, dts.qty, dts.transfer_stock_id, i.name item_name, u.unit uom, i.barcode barcode from transfer_stock_item dts
			join item i on dts.sku = i.sku
			join unit u on i.unit=u.unit_id
			where dts.transfer_stock_id = $ts_id";
		
// 		$po_number = $this->input->post('id');
// 		if (!empty($po_number)) {
// 			$query .= " and d_po.id ilike '%$po_number%'";
// 		}
		
//  		echo $query;
		$q = $this->input->post ( 'q' );
		
		if (! empty ( $q )) {
			$query .= " and (dts.id ilike '%$q%')";
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
		return $this->db->insert ( 'transfer_stock_item', $data );
	}
	function item_update($data, $where) {
		return $this->db->update ( 'transfer_stock_item', $data, $where );
	}
	function item_delete() {
		if ($this->db->delete ( 'transfer_stock_item', array (
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