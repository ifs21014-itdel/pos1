<?php

/**
 * @author Razal.Gurning
 */
class Good_receive extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_good_receive');
    }

    function index() {
        $this->load->view('order_management/good_receive/index');
    }

    function get() {
        echo $this->Model_good_receive->get();
    }

    function input() {
        $this->load->view('order_management/good_receive/input');
    }

    function insert() {
        $this->load->model('system/Model_settings');
        
        $do_date = $this->input->post('do_date');
        $data = array(
            "received_date" => $this->input->post('date'),
            "vendor_id" => $this->input->post('vendor_id'),
            "no_sj" => $this->input->post('no_sj'),
            "do_date" => (empty($do_date) ? null : $do_date),
            "remark" => $this->input->post('remark'),
            "created_by" => $this->session->userdata('id'),
            "received_by" => $this->session->userdata('id'),
            "store_received_id" => $this->Model_settings->get_store_id()
        );

        if ($this->Model_good_receive->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function view_list() {
        $this->load->view('order_management/good_receive/view_list');
    }

    function detail_view() {
        $this->load->view('order_management/good_receive/detail_view');
    }

    function detail_get() {
        echo $this->Model_good_receive->detail_get();
    }

    function detail_input($vendor_id) {
        $this->load->view('order_management/good_receive/detail_input', array("vendor_id" => $vendor_id));
    }

    function detail_save() {
        $good_received_id = $this->input->post('good_received_id');
        $po_detail_id = $this->input->post('po_detail_id');
        $item_id = $this->input->post('item_id');
        $uom_id = $this->input->post('uom_id');
        $unit_conversion = $this->input->post('unit_conversion');
        $qty_receive = $this->input->post('qty_receive');

        $data = array();
        for ($i = 0; $i < count($po_detail_id); $i++) {
            $data[] = array(
                "good_received_id" => $good_received_id,
                "purchase_order_item_id" => $po_detail_id[$i],
                "item_id" => $item_id[$i],
                "uom_id" => $uom_id[$i],
                "unit_conversion" => $unit_conversion[$i],
                "quantity" => $qty_receive[$i]
            );
        }

        if ($this->Model_good_receive->detail_insert_batch($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_edit() {
        $this->load->view('order_management/good_receive/detail_edit');
    }

    function detail_po() {
        $this->load->view('order_management/good_receive/detail_po');
    }

    function item_get() {
        echo $this->Model_good_receive->get_item();
    }

    function item_delete() {
        $this->Model_good_receive->item_delete();
    }
    
    function prints($id) {
        $data['gr'] = $this->Model_good_receive->select_gr_by_id($id);
        $data['item'] = $this->Model_good_receive->select_gr_item_by_gr_id($id);
        $this->load->view('order_management/good_receive/print', $data);
    }
    /*
    function prints($id) {
        $this->load->model('Model_purchase_order');
        $this->load->model('Model_supplier');
        $data['po'] = $this->Model_purchase_order->select_by_id($id);
        $data['supplier'] = $this->Model_supplier->select_by_id($id);
        $data['item'] = $this->Model_purchase_order->select_item_by_po_id($id);
        $this->load->view('order_management/purchase_order/print', $data);
    }*/

}
