<?php

/**
 * @author Razal.Gurning
 */
class Stock_transfer_manifest extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_stock_transfer_manifest');
    }

    function index() {
        $this->load->view('order_management/stock_transfer_manifest/index');
    }

    function list_view() {
        $this->load->view('order_management/stock_transfer_manifest/list_view');
    }

    function get_stock_transfer_manifests_with_pagination() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $filterByCode = $this->input->post('code');
        $filterByStoreResourceName = $this->input->post('store_resource_name');
        $result = $this->Model_stock_transfer_manifest->get_stock_transfer_manifests_with_pagination($page, $rows, $filterByCode, $filterByStoreResourceName);
        echo json_encode($result);
    }

    function form_view() {
        $this->load->view('order_management/stock_transfer_manifest/form_view');
    }

    function add_stock_transfer_manifest() {
        $code = $this->input->post('code');
        $store_destination = $this->input->post('store_destination');
        $ship_date = $this->input->post('ship_date');
        $isSuccess = $this->Model_stock_transfer_manifest->add_stock_transfer_manifest($code, $store_destination, $ship_date);
        $this->getMessageResult($isSuccess);
    }

    function update_stock_transfer_manifest() {
        $id = $this->input->post('id');
        $code = $this->input->post('code');
        $store_destination = $this->input->post('store_destination');
        $ship_date = $this->input->post('ship_date');

        $isSuccess = $this->Model_stock_transfer_manifest->update_stock_transfer_manifest($id, $code, $store_destination, $ship_date);
        $this->getMessageResult($isSuccess);
    }

    function delete_stock_transfer_manifest() {
        $id = $this->input->post('id');
        $isSuccess = $this->Model_stock_transfer_manifest->delete_stock_transfer_manifest($id);
        $this->getMessageResult($isSuccess);
    }

    function confirm_stock_transfer_manifest() {
        $id = $this->input->post('id');
        $isSuccess = $this->Model_stock_transfer_manifest->confirm_stock_transfer_manifest($id);
        $this->getMessageResult($isSuccess);
    }

    /*
     * Stock Transfer Manifest Item 
     */

    function detail_view() {
        $this->load->view('order_management/stock_transfer_manifest/detail_view');
    }

    function item_form_view() {
        $this->load->view('order_management/stock_transfer_manifest/item_form_view');
    }

    function item_form_view_barcode() {
        $this->load->view('order_management/stock_transfer_manifest/item_form_view_barcode');
    }

    function get_stock_transfer_manifest_items_with_pagination() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $stock_transfer_manifest_id = $this->input->post('stock_transfer_manifest_id');
        $filterByItemCode = $this->input->post('code');
        $filterByItemSKU = $this->input->post('sku');

        $this->load->model('Model_stock_transfer_manifest_item');
        $result = $this->Model_stock_transfer_manifest_item->get_stock_transfer_manifest_items_with_pagination($page, $rows, $stock_transfer_manifest_id, $filterByItemCode, $filterByItemSKU);
        echo json_encode($result);
    }

    function add_stock_transfer_manifest_item() {
        $stock_transfer_manifest_id = $this->input->post('stock_transfer_manifest_id');
        $item_id = $this->input->post('item_id');
        $quantity = $this->input->post('quantity');

        $this->load->model('Model_stock_transfer_manifest_item');
        $isSuccess = $this->Model_stock_transfer_manifest_item->add_stock_transfer_manifest_item($stock_transfer_manifest_id, $item_id, $quantity);
        $this->getMessageResult($isSuccess);
    }

    function update_stock_transfer_manifest_item() {
        $id = $this->input->post('id');
        $item_id = $this->input->post('item_id');
        $quantity = $this->input->post('quantity');

        $this->load->model('Model_stock_transfer_manifest_item');
        $isSuccess = $this->Model_stock_transfer_manifest_item->update_stock_transfer_manifest_item($id, $item_id, $quantity);
        $this->getMessageResult($isSuccess);
    }

    function delete_stock_transfer_manifest_item() {
        $id = $this->input->post('id');
        $this->load->model('Model_stock_transfer_manifest_item');
        $isSuccess = $this->Model_stock_transfer_manifest_item->delete_stock_transfer_manifest_item($id);
        $this->getMessageResult($isSuccess);
    }

    function prints($id) {
        $this->load->model('Model_good_receive_ts');
        $data['gr_ts'] = $this->Model_good_receive_ts->select_by_id($id);
        $data['item'] = $this->Model_good_receive_ts->select_item_by_ts_id($id);
        $this->load->view('order_management/stock_transfer_manifest/print', $data);
    }

    function save_from_request_transfer() {
        $decode = json_decode($this->input->post("data"));
        $header = $decode->header;
        $details = $decode->details;

        $this->load->model("system/Model_settings");
        $store_source_id = $this->Model_settings->get_setting_value("STORE_ID");

        $stm = array(
            "store_source_id" => $store_source_id,
            "user_id" => $this->session->userdata('id'),
            "store_destination_id" => $header->store_destination_id,
            "ship_date" => $header->ship_date,
            "transfer_stock_request_id" => $header->transfer_stock_request_id
        );

        $error_message = "";
        $this->db->trans_start();
        if ($this->db->insert("stock_transfer_manifest", $stm)) {
            $stock_transfer_manifest_id = $this->Model_stock_transfer_manifest->get_last_id($store_source_id);
            $stm_item = array();
            foreach ($details as $detail) {
                $stm_item[] = array(
                    "stock_transfer_manifest_id" => $stock_transfer_manifest_id,
                    "transfer_stock_request_item_id" => $detail->transfer_stock_request_item_id,
                    "item_id" => $detail->item_id,
                    "quantity" => $detail->qty
                );
            }
            if (!$this->db->insert_batch("stock_transfer_manifest_item", $stm_item)) {
                $error_message = $this->db->_error_message();
            }
        } else {
            $error_message = $this->db->_error_message();
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $error_message));
        }
    }

}
