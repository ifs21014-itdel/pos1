<?php

/**
 * @author Razal.Gurning
 */
class Customer extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_customer');
    }

    function index() {
        $this->load->view('master/customer/index');
    }

    function get_customer_with_pagination() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $filterByName = $this->input->post('name');
        $result = $this->Model_customer->get_customer_with_pagination($page, $rows, $filterByName);
        echo json_encode($result);
    }

    function view_list() {
        $this->load->view('master/customer/view_list');
    }

    function input_form() {
        $data['customer_type'] = $this->Model_customer->select_all_customer_type();
        $this->load->view('master/customer/input_form', $data);
    }

    function add_customer() {

        $date_of_birth = $this->input->post('date_of_birth');
        $data = array(
            "name" => $this->input->post('name'),
            "barcode" => $this->Model_customer->get_next_card_number($this->input->post('customer_type_id')),
            "date_of_birth" => (empty($date_of_birth) ? null : $date_of_birth),
            "address" => $this->input->post('address'),
            "discount" => (double) $this->input->post('discount'),
            "customer_type_id" => $this->input->post('customer_type_id'),
            "gender" => $this->input->post('gender'),
            "religion" => $this->input->post('religion'),
            "city" => $this->input->post('city'),
            "state" => $this->input->post('state'),
            "region" => $this->input->post('region'),
            "occupation" => $this->input->post('occupation'),
            "phone_number" => $this->input->post('phone_number'),
            "email" => $this->input->post('email'),
            "point" => (double) $this->input->post('point'),
            "status" => $this->input->post('status')
        );

        $isSuccess = $this->Model_customer->add_customer($data);
        $this->getMessageResult($isSuccess);
    }

    function update_customer() {
        $date_of_birth = $this->input->post('date_of_birth');
        $data = array(
            "name" => $this->input->post('name'),
            "date_of_birth" => (empty($date_of_birth) ? null : $date_of_birth),
            "address" => $this->input->post('address'),
            "discount" => (double) $this->input->post('discount'),
            "customer_type_id" => $this->input->post('customer_type_id'),
            "gender" => $this->input->post('gender'),
            "religion" => $this->input->post('religion'),
            "city" => $this->input->post('city'),
            "state" => $this->input->post('state'),
            "region" => $this->input->post('region'),
            "occupation" => $this->input->post('occupation'),
            "phone_number" => $this->input->post('phone_number'),
            "email" => $this->input->post('email'),
            "point" => (double) $this->input->post('point'),
            "status" => $this->input->post('status'),
            "time_update" => "now()"
        );
        $isSuccess = $this->Model_customer->update_customer($data, array("id" => $this->input->post('id')));
        $this->getMessageResult($isSuccess);
    }

    function delete_customer() {
        $id = $this->input->post('id');
        $isSuccess = $this->Model_customer->delete_customer($id);
        $this->getMessageResult($isSuccess);
    }

    function get_customer_by_barcode() {
        $barcode = $this->input->post("barcode");
        $result = $this->Model_customer->get_customer_by_barcode($barcode);
        echo json_encode($result);
    }

}
