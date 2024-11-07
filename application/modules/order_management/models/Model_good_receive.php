<?php

/**
 * Model po
 *
 * @author Rizal.Gurning
 */
class Model_good_receive extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    function select_gr_by_id($id) {
        $query = "
        	select 
            gr.*,vendor.code vendor_code,vendor.name vendor_name
            from good_received gr 
            join vendor on gr.vendor_id=vendor.id 
            where  gr.id=$id
        ";
        return $this->db->query($query)->row();
// 		print_r($query);exit();
    }

    function select_gr_item_by_gr_id($id) {
        $query = "select
            gri.*,i.sku sku, i.barcode item_code, i.name item_name, u.code unit_code,poi.quantity order_qty, po.reference
            from good_received_item gri
            join item i on gri.item_id=i.id
            join uom u on gri.uom_id = u.id
            join purchase_order_item poi on gri.purchase_order_item_id=poi.id
            join purchase_order po on poi.purchase_order_id=po.id
            where gri.good_received_id= $id";
        return $this->db->query($query)->result();
    }
    
    function get() {
        $query = "
            select 
            gr.*,vendor.code vendor_code,vendor.name vendor_name
            from good_received gr 
            join vendor on gr.vendor_id=vendor.id 
            where true 
        ";

        $q = $this->input->post('q');

        if (!empty($q)) {
            $query .= " and (vendor.code ilike '%$q%' or vendor.name ilike '%$q%' or gr.reference ilike '%$q%')";
        }
        $query.=" order by gr.id desc";
//        echo $query;
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

    function detail_get() {

        $good_receive_id = $this->input->post('good_receive_id');
        if (empty($good_receive_id)) {
            $good_receive_id = 0;
        }

        $query = "
            select
            gri.*,i.sku sku, i.barcode item_code, i.name item_name, u.code unit_code,poi.quantity order_qty, po.reference
            from good_received_item gri
            join item i on gri.item_id=i.id
            join uom u on gri.uom_id = u.id
            join purchase_order_item poi on gri.purchase_order_item_id=poi.id
            join purchase_order po on poi.purchase_order_id=po.id
            where gri.good_received_id=$good_receive_id 
        ";


        $query .= " order by gri.id desc ";
        
//        echo $query;
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

    function detail_insert_batch($data) {
        return $this->db->insert_batch("good_received_item", $data);
    }

    // detail item for PO
    function get_item() {

        $po_id = $this->input->post('id');
        if (empty($po_id)) {
            $po_id = 0;
        }

        $query = "select d_po.*, i.barcode item_code, i.name item_name from purchase_order_item d_po
				  join item i on d_po.item_id = i.id 
				where d_po.purchase_order_id = $po_id";

        $q = $this->input->post('q');

        if (!empty($q)) {
            $query .= " and (detail_po.id ilike '%$q%')";
        }

        $query .= " order by id desc ";
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
        return $this->db->insert('good_received', $data);
    }

    function update($data, $where) {
        return $this->db->update('good_received', $data, $where);
    }

    function item_insert($data) {
        return $this->db->insert('detail_po', $data);
    }

    function item_update($data, $where) {
        return $this->db->update('detail_po', $data, $where);
    }

    function item_delete() {
        if ($this->db->delete('detail_po', array(
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

}

?>