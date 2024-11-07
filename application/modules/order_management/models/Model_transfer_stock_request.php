<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_transfer_stock_request
 *
 * @author operational
 */
class Model_transfer_stock_request extends MY_Model {

    //put your code here
    public $table_name = "transfer_stock_request";

    public function __construct() {
        parent::__construct();
    }

    function get() {

        $query = "
            select 
                    tsr.*,s1.name store_source_name,s2.name  store_destination_name,u.first_name request_by
            from transfer_stock_request tsr
                    left join store s1 on tsr.store_source_id=s1.id
                    left join store s2 on tsr.store_destination_id=s2.id
                    left join kds_user u on tsr.user_id=u.id
            where true
        ";
// 		echo $query;

        $q = $this->input->post('q');

        if (!empty($q)) {
            $query .= " and (tsr.code ilike '%$q%' or s1.name ilike '%$q%' or s2.name ilike '%$q%')";
        }

        $type = $this->input->post("type");
        if (!empty($type)) {
            $this->load->model("system/Model_settings");
            $store_id = $this->Model_settings->get_setting_value("STORE_ID");
            if ($type === 'incoming') {
                $query .= " and tsr.store_source_id=$store_id ";
            } else if ($type === 'outgoing') {
                $query .= " and tsr.store_destination_id=$store_id ";
            }
        }

        $query .= " order by tsr.id desc ";
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
        return $this->db->insert('transfer_stock_request', $data);
    }

    function update($data, $where) {
        return $this->db->update('transfer_stock_request', $data, $where);
    }

    function delete($where) {
        if ($this->db->delete('transfer_stock_request', $where)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_get($tsr_id) {

        $transfer_stock_request_id = $this->input->post('transfer_stock_request_id');
        if (empty($transfer_stock_request_id)) {
            $transfer_stock_request_id = 0;
        }
        if (!empty($tsr_id)) {
            $transfer_stock_request_id = $tsr_id;
        }

        $query = " 
            select 
                tsri.*,i.sku,i.name item_name,u.code uom 
            from 
                transfer_stock_request_item tsri 
                join item i on tsri.item_id=i.id
                left join uom u on u.id = i.uom_id
            where tsri.transfer_stock_request_id=$transfer_stock_request_id ";

        $q = $this->input->post('q');

        if (!empty($q)) {
            $query .= " and (i.sku ilike '%$q%' or i.name ilike '%$q%')";
        }

        $query .= " order by tsri.id desc ";

//        echo "<pre>$query</pre>";
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

    function detail_insert($data) {
        return $this->db->insert('transfer_stock_request_item', $data);
    }

    function detail_update($data, $where) {
        return $this->db->update('transfer_stock_request_item', $data, $where);
    }

    function detail_delete() {
        if ($this->db->delete('transfer_stock_request_item', array(
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
    
    function get_code_transfer_stock_request_by_id($id) {
        $query = "select ts.code from transfer_stock_request ts where ts.id = ? ";
        $param = array(
            $id
        );
        $result = $this->execute_query_as_row($query, $param);
        if (isset($result)) {
            return $result->code;
        }
        return null;
    }
    
    function update_status_transfer_stock_request($id, $status) {
        $data = array(
            "is_synchronized" => $status
        );
        $where = array(
            "id" => $id
        );
        return $this->update($data, $where);
    }
}
