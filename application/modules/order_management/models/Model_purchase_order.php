<?php

/**
 * Model po
 *
 * @author Rizal.Gurning
 */
class Model_purchase_order extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function select_by_id($id) {
        $query = "
        	select po.*, date(po.created_date) tanggal,  store.name store_name, store.address store_address, vendor.name vendor_name, vendor.code vendor_code, vendor.address vendor_address, vendor.npwp vendor_npwp, vendor.discount as discount, vendor.pkp as pkp, vendor.term_of_payment term_of_payment,
				case when po.status = '0' then 'DRAFT'
				when po.status = '1' then 'OPEN'
				when po.status = '2' then 'CLOSE'
				when po.status = '3' then 'RELEASE'
				when po.status = '4' then 'FINISHED'
				else 'Cancel' end as status
				from purchase_order po
				join store on po.store_destination_id= store.id
				join vendor on po.vendor_id= vendor.id
				where po.id=$id
                                order by po.status, po.id
        ";
        return $this->db->query($query)->row();
// 		print_r($query);exit();
    }

    function select_item_by_po_id($po_id) {
        $query = "select d_po.*, d_po.unit_conversion*d_po.quantity total_qty, d_po.unit_conversion*d_po.quantity*d_po.price total_price, 
                i.sku item_code, i.name item_name, u.code unit_code, i.barcode
                from purchase_order_item d_po
		join item i on d_po.item_id = i.id
		join uom u on d_po.uom_id = u.id
		where d_po.purchase_order_id = $po_id
                order by d_po.id";
        return $this->db->query($query)->result();
    }

    function get() {
        $query = "
        	select po.*, store.name nama_toko, vendor.name nama_supplier, 
				case when po.status = '0' then 'DRAFT' 
				when po.status = '1' then 'OPEN' 
				when po.status = '2' then 'CLOSE' 
				when po.status = '3' then 'RELEASE'
				when po.status = '4' then 'FINISHED' 
				else 'Cancel' end as status 
				from purchase_order po
				join store on po.store_destination_id= store.id
				join vendor on po.vendor_id= vendor.id
				where true
        ";

        $number = $this->input->post('number');

        if (!empty($number)) {
            $query .= " and (po.id='$number')";
        }

        $q = $this->input->post('q');

        if (!empty($q)) {
            $query .= " and (purchase_order.reference ilike '%$q%' or purchase_order.name ilike '%$q%')";
        }

        $query .= " order by po.status, po.id desc";
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result ['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array(
                'rows' => $this->db->query($query)->result()
            ));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function insert($data) {
        return $this->db->insert('purchase_order', $data);
    }

    function update($data, $where) {
        return $this->db->update('purchase_order', $data, $where);
    }

    function delete() {
        if ($this->db->delete('purchase_order', array(
                    "id" => $this->input->post('id')
                ))) {
            echo json_encode(array(
                'success' => true
            ));
        } else {
            echo json_encode(array(
                'msg' => $this->db->_error_message()
            ));
        }
    }

    // detail item for PO
    function get_item() {

        $po_id = $this->input->post('id');
        if (empty($po_id)) {
            $po_id = 0;
        }

        $query = "select d_po.*, d_po.unit_conversion*d_po.quantity total_qty, d_po.unit_conversion*d_po.quantity*d_po.price total_price, i.sku sku, i.barcode item_code, i.name item_name, u.code unit_code from purchase_order_item d_po
		join item i on d_po.item_id = i.id
		join uom u on d_po.uom_id = u.id	
				where d_po.purchase_order_id = $po_id";

// 		$po_number = $this->input->post('id');
// 		if (!empty($po_number)) {
// 			$query .= " and d_po.id ilike '%$po_number%'";
// 		}
// 		echo $query;
        $q = $this->input->post('q');

        if (!empty($q)) {
            $query .= " and (detail_po.id ilike '%$q%')";
        }

        $query .= " order by id asc ";
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result ['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array(
                'rows' => $this->db->query($query)->result()
            ));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function item_insert($data) {
        return $this->db->insert('purchase_order_item', $data);
    }

    function item_update($data, $where) {
        return $this->db->update('purchase_order_item', $data, $where);
    }

    function item_delete() {
        if ($this->db->delete('purchase_order_item', array(
                    "id" => $this->input->post('id')
                ))) {
            echo json_encode(array(
                'success' => true
            ));
        } else {
            echo json_encode(array(
                'msg' => $this->db->_error_message()
            ));
        }
    }

    //-------------------- mth

    function get_vendor_ots_delivery() {
        $query = "
          with t as (
                select distinct po.vendor_id id
                from purchase_order_item po_item
                join purchase_order po on po_item.purchase_order_id=po.id
                where po_item.outstanding_receive > 0
        ) select t.*,vendor.code vendor_code,vendor.name vendor_name from t join vendor on t.id=vendor.id where true  
        ";

        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and  (vendor.code  ilike '%$q%' or vendor.name  ilike '%$q%')";
        }
        return json_encode($this->db->query($query)->result());
    }

    function get_item_available_to_receive($vendor_id) {

        $query = "select d_po.*,d_po.outstanding_receive qty_receive,po.reference, i.sku sku, i.barcode item_code, i.name item_name, u.code unit_code from purchase_order_item d_po
                join item i on d_po.item_id = i.id
                join uom u on i.uom_id = u.id
                join purchase_order po on d_po.purchase_order_id=po.id	
                where po.vendor_id=$vendor_id and d_po.outstanding_receive > 0";

        $q = $this->input->post('q');

        if (!empty($q)) {
            $query .= " and (po.reference ilike '%$q%')";
        }

        $query .= " order by d_po.id asc ";
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result ['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array(
                'rows' => $this->db->query($query)->result()
            ));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

}

?>