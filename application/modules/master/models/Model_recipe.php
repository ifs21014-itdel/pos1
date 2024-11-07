<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_recipe
 *
 * @author operational
 */
class Model_recipe extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get() {

        $query = "
            select r.*,i.sku,i.name,u.code uom
            from recipe r 
            join item i on r.item_id=i.id
            left join uom u on i.uom_id=u.id
            where true
            ";
        
        $q = $this->input->post('q');
        if(!empty($q)){
            $query .= " and (i.sku ilike '%$q%' or i.name ilike '%$q%' or u.code ilike '%$q%')";
        }
        
        $query .= " order by r.id desc ";

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
        return $this->db->insert('recipe', $data);
    }

    function update($data, $where) {
        return $this->db->update('recipe', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('recipe', $where);
    }

    function detail_get() {

        $recipe_id = $this->input->post("recipe_id");
        if (empty($recipe_id)) {
            $recipe_id = 0;
        }

        $query = "
            select ri.*,i.sku,i.name,uom.code uom
            from recipe_item ri 
            join item i on ri.item_id=i.id
            left join uom on i.uom_id=uom.id
            where ri.recipe_id=$recipe_id
        ";
        $q = $this->input->post('q');
        if(!empty($q)){
            $query .= " and (i.sku ilike '%$q%' or i.name ilike '%$q%' or uom.code ilike '%$q%')";
        }
        $query .= " order by ri.id desc ";

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

    function detail_insert($data) {
        return $this->db->insert('recipe_item', $data);
    }

    function detail_update($data, $where) {
        return $this->db->update('recipe_item', $data, $where);
    }

    function detail_delete($where) {
        return $this->db->delete('recipe_item', $where);
    }

}
