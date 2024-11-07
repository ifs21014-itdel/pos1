<?php

/**
 * Controller transfer request
 *
 * @author Razal.Gurning
 */
class Transfer_req extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_transfer_req');
    }

    function index() {
        $this->load->view('master/transfer_req/index');
    }

    function get() {
        echo $this->model_transfer_req->get();
    }

    function view_list() {
        $this->load->view('master/transfer_req/view_list');
    }

    function input_form() {
        $this->load->view('master/transfer_req/input_form');
    }

    function item_tr_form() {
        $this->load->view('master/transfer_req/item_tr_form');
    }

    function save($id) {
        $data = array(
            "id" => $this->input->post('id'),
            "request_to_store" => $this->input->post('request_to_store'),
            "date_received_est" => $this->input->post('date_received_est'),
        );
        if ($id == 0) {
            // call method insert transfer_req
            if ($this->model_transfer_req->insert($data)) {
                echo json_encode(array(
                    'success' => true
                ));
            } else {
                echo json_encode(array(
                    'msg' => $this->db->_error_message()
                ));
            }
        } else {
            // call method update transfer_req

            if ($this->model_transfer_req->update($data, array(
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
        $this->model_transfer_req->delete();
    }

    function detail_tr() {
        $this->load->view('master/transfer_req/detail_tr');
    }

    function item_get() {
        echo $this->model_transfer_req->get_item();
    }

    function item_save($id, $id_ts) {
        $data = array(
            "barcode" => $this->input->post('item_name'),
            "quantity" => $this->input->post('quantity'),
        );

        if ($id == 0) {
            // call method insert ts
            $data['id_ts'] = $id_ts;
            if ($this->model_transfer_req->item_insert($data)) {
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
            if ($this->model_transfer_req->item_update($data, array(
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

    function item_delete() {
        $this->model_transfer_req->item_delete();
    }

}
