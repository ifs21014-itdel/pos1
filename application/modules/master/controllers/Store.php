<?php

/**
 * @author Razal.Gurning
 */
class Store extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_store');
    }

    function index() {
        $this->load->view('master/store/index');
    }

    function get_stores() {
        $result = $this->Model_store->get_stores();
        echo json_encode($result);
    }

    function get_store_exclude_self() {
        $result = $this->Model_store->get_store_exclude_self();
        echo json_encode($result);
    }

    function get() {
        echo $this->Model_store->get();
    }

    function get_stores_with_pagination() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $filterByName = $this->input->post('name');
        $result = $this->Model_store->get_stores_with_pagination($page, $rows, $filterByName);
        echo json_encode($result);
    }

    function view_list() {
        $this->load->view('master/store/view_list');
    }

    function input_form() {
        $this->load->view('master/store/input_form');
    }

    function add_store() {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $serial_number = $this->input->post('serial_number');
        $isSuccess = $this->Model_store->add_store($code, $name, $address, $serial_number);
        $this->getMessageResult($isSuccess);
    }

    function update_store() {
        $id = $this->input->post('id');
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $serial_number = $this->input->post('serial_number');
        $isSuccess = $this->Model_store->update_store($id, $code, $name, $address, $serial_number);
        $this->getMessageResult($isSuccess);
    }

    function delete_store() {
        $ids = $this->input->post('id');
        $isSuccess = $this->Model_store->delete_store($ids);
        $this->getMessageResult($isSuccess);
    }

}
