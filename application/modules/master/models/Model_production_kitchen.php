<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_production_kitchen
 *
 * @author operational
 */
class Model_production_kitchen extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get() {

        $query = "
            select kp.*,i.sku,i.name,u.code uom,usr.first_name
            from kitchen_production kp 
            join item i on kp.item_id=i.id
            left join kds_user usr on kp.chef=usr.id
            left join uom u on i.uom_id=u.id
            where true
            ";
        
        $q = $this->input->post('q');
        if(!empty($q)){
            $query .= " and (i.sku ilike '%$q%' or i.name ilike '%$q%' or u.code ilike '%$q%' or usr.first_name ilike '%$q%')";
        }
        
        $query .= " order by kp.id desc ";
        
        
        
        //echo $query;

        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function insert($data) {
        return $this->db->insert('kitchen_production', $data);
    }

    function update($data, $where) {
        return $this->db->insert('kitchen_production', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('kitchen_production', $where);
    }

    function confirm($id, $itemid,$qty) {
        return $this->db->query("select kitchen_production_confirm($id,$itemid,$qty)");
    }

    function detail_get() {

        $kitchen_production_id = $this->input->post("production_kitchen_id");
        if (empty($kitchen_production_id)) {
            $kitchen_production_id = 0;
        }

        $query = "
            select kpi.*,i.sku,i.name,uom.code uom
            from kitchen_production_item kpi 
            join item i on kpi.item_id=i.id
            left join uom on i.uom_id=uom.id
            where kpi.kitchen_production_id=$kitchen_production_id
        ";
        
        $q = $this->input->post('q');
        if(!empty($q)){
            $query .= " and (i.sku ilike '%$q%' or i.name ilike '%$q%' or uom.code ilike '%$q%')";
        }
        
        $query .= " order by kpi.id desc ";

//        echo $query;

        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function detail_insert($data) {
        return $this->db->insert('kitchen_production_item', $data);
    }

    function detail_update_batch($data, $index) {
        return $this->db->update_batch('kitchen_production_item', $data, $index);
    }

    function detail_update($data, $where) {
        return $this->db->update('kitchen_production_item', $data, $where);
    }

    function detail_delete($where) {
        return $this->db->delete('kitchen_production_item', $where);
    }

}
