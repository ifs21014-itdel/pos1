<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transfer_stock_request
 *
 * @author operational
 */
class Transfer_stock_request extends MX_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_transfer_stock_request');
    }

    function index() {
        $this->load->view('order_management/transfer_stock_request/index');
    }

    function get() {
        echo $this->model_transfer_stock_request->get();
    }

    function header() {
        $this->load->model("system/Model_settings");
        $store_id = $this->Model_settings->get_setting_value("STORE_ID");
        $this->load->view('order_management/transfer_stock_request/header', array("store_id" => $store_id));
    }

    function input() {
        $this->load->view('order_management/transfer_stock_request/input');
    }

    function save($id) {

        $this->load->model("system/Model_settings");
        $store_destination_id = $this->Model_settings->get_setting_value("STORE_ID");

        $data = array(
            "store_source_id" => $this->input->post('store_source_id'),
            "store_destination_id" => $store_destination_id,
            "expected_receive_date" => $this->input->post('expected_receive_date'),
            "description" => $this->input->post('description'),
            "user_id" => $this->session->userdata('id')
        );

        if ($id == 0) {
            // call method insert transfer_stock_request
            if ($this->model_transfer_stock_request->insert($data)) {
                echo json_encode(array(
                    'success' => true
                ));
            } else {
                echo json_encode(array(
                    'msg' => $this->db->_error_message()
                ));
            }
        } else {
            // call method update transfer_stock_request

            if ($this->model_transfer_stock_request->update($data, array(
                        "id" => $id
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
        // 		echo json_encode ( array (
        // 				'success' => true 
        // 		) );
    }

    function delete() {
        $this->model_transfer_stock_request->delete(array("id" => $this->input->post('id')));
    }

    function confirm() {
        if ($this->model_transfer_stock_request->update(array("status" => 1), array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail() {
        $this->load->view('order_management/transfer_stock_request/detail');
    }

    function detail_get($tsr_id = "") {
        echo $this->model_transfer_stock_request->detail_get($tsr_id);
    }

    function detail_input() {
        $this->load->view('order_management/transfer_stock_request/detail_input');
    }

    function detail_save($id, $id_ts) {
        $data = array(
            "item_id" => $this->input->post('item_id'),
            "quantity" => (double) $this->input->post('quantity'),
            "outstanding" => (double) $this->input->post('quantity')
        );

        if ($id == 0) {
            // call method insert ts
            $this->load->model("master/Model_stock_item");
            $data['transfer_stock_request_id'] = $id_ts;
            $data['available'] = $this->Model_stock_item->get_stock($data["item_id"]);
            if ($this->model_transfer_stock_request->detail_insert($data)) {
                echo json_encode(array(
                    'success' => true
                ));
            } else {
                echo json_encode(array(
                    'msg' => $this->db->_error_message()
                ));
            }
        } else {
            // call method update po
            // 			$data["last_update"] = "now()";
            if ($this->model_transfer_stock_request->detail_update($data, array(
                        "id" => $id
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

    function detail_delete() {
        $this->model_transfer_stock_request->detail_delete();
    }

    function create_transfer($tsrid) {
        $this->load->view('order_management/transfer_stock_request/create_transfer', array("tsrid" => $tsrid));
    }

}
