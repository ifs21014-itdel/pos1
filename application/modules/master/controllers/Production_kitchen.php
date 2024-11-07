<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Production_kitchen
 *
 * @author operational
 */
class Production_kitchen extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_production_kitchen');
    }

    function index() {
        $this->load->view('master/production_kitchen/index');
    }

    function header() {
        $this->load->view('master/production_kitchen/header');
    }

    function get() {
        echo $this->model_production_kitchen->get();
    }

    function input() {
        $this->load->view('master/production_kitchen/input');
    }

    function save($id) {

        $data = array(
            "item_id" => $this->input->post("item_id"),
            "quantity" => $this->input->post("quantity"),
            "chef" => $this->input->post("chef")
        );

        if ($id == 0) {
            if ($this->model_production_kitchen->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_production_kitchen->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        if ($this->model_production_kitchen->delete(array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function confirm() {
        if ($this->model_production_kitchen->confirm($this->input->post("id"), $this->input->post("item_id"),$this->input->post("qty"))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail() {
        $this->load->view('master/production_kitchen/detail');
    }

    function detail_get() {
        echo $this->model_production_kitchen->detail_get();
    }

    function detail_input() {
        $this->load->view('master/production_kitchen/detail_input');
    }

    function detail_save() {
        $temp = $this->input->post("data");
        $detail = json_decode($temp);
        $data = array();
        foreach ($detail as $rst) {
            $defect = ((double) $rst->raw_quantity) - ((double) $rst->production_quantity);
            $data[] = array(
                "id" => $rst->id,
                "raw_quantity" => (double) $rst->raw_quantity,
                "production_quantity" => (double) $rst->production_quantity,
                "defect_quantity" => $defect
            );
        }

        if ($this->model_production_kitchen->detail_update_batch($data, "id")) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_delete() {
        if ($this->model_production_kitchen->detail_delete(array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
