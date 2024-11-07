<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Recipe
 *
 * @author operational
 */
class Recipe extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_recipe');
    }

    function index() {
        $this->load->view('master/recipe/index');
    }

    function header() {
        $this->load->view('master/recipe/header');
    }

    function get() {
        echo $this->model_recipe->get();
    }

    function input() {
        $this->load->view('master/recipe/input');
    }

    function save($id) {

        $data = array(
            "item_id" => $this->input->post("item_id"),
            "description" => $this->input->post("description"),
            "shelf_life" => $this->input->post("shelf_life")
        );

        if ($id == 0) {
            if ($this->model_recipe->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_recipe->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        if ($this->model_recipe->delete(array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail() {
        $this->load->view('master/recipe/detail');
    }

    function detail_get() {
        echo $this->model_recipe->detail_get();
    }

    function detail_input() {
        $this->load->view('master/recipe/detail_input');
    }

    function detail_save($id, $receipe_id) {
        $type = $this->input->post("type");
//        $this->load->model('model_item');
//        $cost_per_unit = 0;
//        if ($type == 1 || $type == 3) {
//            $cost_per_unit = $this->model_item->get_cost_by_item_id($this->input->post("item_id"));
//        }

        $data = array(
            "item_id" => $this->input->post("item_id"),
            "quantity" => $this->input->post("quantity"),
            "status" => $this->input->post("status"),
            "recipe_id" => $receipe_id,
            "type" => $type,
//            "cost_per_unit" => $cost_per_unit
        );

        if ($id == 0) {
            if ($this->model_recipe->detail_insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            $data["updated_date"] = "now()";
            if ($this->model_recipe->detail_update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function detail_delete() {
        if ($this->model_recipe->detail_delete(array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
