<?php

/**
 * @author Razal.Gurning
 */
class Purchase_order extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_purchase_order');
    }

    function index() {
        $this->load->view('order_management/purchase_order/index');
    }

    function get() {
        echo $this->Model_purchase_order->get();
    }

    function view_list() {
        $this->load->view('order_management/purchase_order/view_list');
    }

    function input_form() {
        $this->load->view('order_management/purchase_order/input_form');
    }

    function item_po_form() {
        $this->load->view('order_management/purchase_order/item_po_form');
    }

    function save($id) {
        $data = array(
            "vendor_id" => $this->input->post('vendor_id'),
            "currency" => $this->input->post('currency'),
            "shipment_date" => $this->input->post('shipment_date'),
            "shipment_address" => $this->input->post('shipment_address'),
            "store_destination_id" => $this->input->post('store_destination_id')
        );
        if ($id == 0) {
            // call method insert po
            $data["created_by"] = $this->session->userdata('id');
            if ($this->Model_purchase_order->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            $data["updated_by"] = $this->session->userdata('id');
            $data["updated_date"] = "now()";
            if ($this->Model_purchase_order->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $this->Model_purchase_order->delete();
    }

    // status PO Open
    function po_open() {
        if ($this->Model_purchase_order->update(array('status' => '1'), array('id' => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    // status PO Close
    function po_close() {
    if ($this->Model_purchase_order->update(array('status' => '2'), array('id' => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    // status PO Release
    function po_release() {
        if ($this->Model_purchase_order->update(array('status' => '3'), array('id' => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    // status PO Finish
    function po_finish() {
    if ($this->Model_purchase_order->update(array('status' => '4'), array('id' => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_po() {
        $this->load->view('order_management/purchase_order/detail_po');
    }

    function prints($id) {
        $data['po'] = $this->Model_purchase_order->select_by_id($id);
        $data['item'] = $this->Model_purchase_order->select_item_by_po_id($id);
        $this->load->view('order_management/purchase_order/print', $data);
    }

    function item_get() {
        echo $this->Model_purchase_order->get_item();
    }

    function item_save($id, $po_id) {
        $data = array(
            "item_id" => $this->input->post('item_id'),
            "uom_id" => $this->input->post('uom_id'),
            "unit_conversion" => $this->input->post('unit_conversion'),
            "quantity" => $this->input->post('quantity'),
            "price" => $this->input->post('price'),
            "outstanding_receive" => $this->input->post('quantity'),
            "trade_status" => $this->input->post('ts_id'),
        );

        if ($id == 0) {
            // call method insert po
            $data['purchase_order_id'] = $po_id;
            if ($this->Model_purchase_order->item_insert($data)) {
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
            if ($this->Model_purchase_order->item_update($data, array(
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
        $this->Model_purchase_order->item_delete();
    }

    //-----------------------

    function get_vendor_ots_delivery() {
        echo $this->Model_purchase_order->get_vendor_ots_delivery();
    }

    function get_item_available_to_receive($vendor_id) {
        echo $this->Model_purchase_order->get_item_available_to_receive($vendor_id);
    }

}
