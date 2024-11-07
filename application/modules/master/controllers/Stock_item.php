<?php

/**
 * Controller Item
 *
 * @author Razal.Gurning
 */
class Stock_item extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_stock_item');
    }

    function index() {
        $this->load->view('master/stock_item/index');
    }

//     function get_data() {
//         $this->model_item->get_data();
//     }

    function get_stock_item_with_pagination() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $filterByName = $this->input->post('search');
        $filterByStore = $this->input->post('store_id');
        $result = $this->Model_stock_item->get_stock_item_with_pagination($page, $rows, $filterByName, $filterByStore);
        echo json_encode($result);
    }

    function view_list() {
    	$data["store"] = $this->db->query("select * from store order by id asc")->result();
        $this->load->view('master/stock_item/view_list', $data);
    }

//     function input_form() {
//         $this->load->view('master/item/input_form');
//     }

//     function add_item() {
//         $sku = $this->input->post('sku');
//         $name = $this->input->post('name');
//         $barcode = $this->input->post('barcode');
//         $cost = $this->input->post('cost');
//         $category1 = $this->input->post('category1');
//         $category2 = $this->input->post('category2');
//         $category3 = $this->input->post('category3');
//         $category4 = $this->input->post('category4');
//         $uom_id = $this->input->post('uom_id');
//         $carton = $this->input->post('carton');
//         $inner = $this->input->post('inner');
//         $retail_price = $this->input->post('retail_price');
//         $trading_price = $this->input->post('trading_price');
//         $bkp = $this->input->post('taxed');
//         $consignment = $this->input->post('consignment');
//         $type = $this->input->post('type');
//         $bom_status = $this->input->post('bom_status');
//         $isSuccess = $this->model_item->add_item($sku, $name, $barcode, $cost, $category1, $category2, $category3, $category4, $uom_id, $carton, $inner, $retail_price, $bkp, $consignment, $type, $trading_price, $bom_status);
//         $this->getMessageResult($isSuccess);
//     }

//     function update_item() {
//         $id = $this->input->post('id');
//         $sku = $this->input->post('sku');
//         $name = $this->input->post('name');
//         $barcode = $this->input->post('barcode');
//         $cost = $this->input->post('cost');
//         $category1 = $this->input->post('category1');
//         $category2 = $this->input->post('category2');
//         $category3 = $this->input->post('category3');
//         $category4 = $this->input->post('category4');
//         $uom_id = $this->input->post('uom_id');
//         $carton = $this->input->post('carton');
//         $inner = $this->input->post('inner');
//         $retail_price = $this->input->post('retail_price');
//         $bkp = $this->input->post('taxed');
//         $consignment = $this->input->post('consignment');
//         $type = $this->input->post('type');
//         $trading_price = $this->input->post('trading_price');
//         $bom_status = $this->input->post('bom_status');
//         $isSuccess = $this->model_item->update_item($id, $sku, $name, $barcode, $cost, $category1, $category2, $category3, $category4, $uom_id, $carton, $inner, $retail_price, $bkp, $consignment, $type, $trading_price, $bom_status);
//         $this->getMessageResult($isSuccess);
//     }

//     function delete_item() {
//         $id = $this->input->post('id');
//         $isSuccess = $this->model_item->delete_item($id);
//         $this->getMessageResult($isSuccess);
//     }

//     function bom($itemid) {
//         $data["itemid"] = $itemid;
//         $this->load->view('master/item/bom', $data);
//     }

//     function bom_input() {
//         $this->load->view('master/item/bom_input');
//     }

//     function bom_save($itemid, $id) {
//         $data = array(
//             "raw_item_id" => $this->input->post("raw_item_id"),
//             "uom_id" => $this->input->post("uom_id"),
//             "qty" => $this->input->post("qty")
//         );

//         if ($id == 0) {
//             $data["item_id"] = $itemid;
//             if ($this->db->insert("bill_of_materials_item", $data)) {
//                 echo json_encode(array('success' => true));
//             } else {
//                 echo json_encode(array('msg' => $this->db->_error_message()));
//             }
//         } else {
//             if ($this->db->update("bill_of_materials_item", $data, array("id" => $id))) {
//                 echo json_encode(array('success' => true));
//             } else {
//                 echo json_encode(array('msg' => $this->db->_error_message()));
//             }
//         }
//     }

//     function bom_delete() {
//         if ($this->db->delete("bill_of_materials_item", array("id" => $this->input->post("id")))) {
//             echo json_encode(array('success' => true));
//         } else {
//             echo json_encode(array('msg' => $this->db->_error_message()));
//         }
//     }

//     function bom_get($itemid = 0) {
//         $query = "
//             select bill_of_materials_item.*,item.sku,item.barcode,item.name,uom.code unit_code from bill_of_materials_item 
//             join item on bill_of_materials_item.raw_item_id=item.id
//             join uom on item.uom_id=uom.id
//             where bill_of_materials_item.item_id=$itemid
//             ";
//         $query .= " order by bill_of_materials_item.id desc ";

// //        echo $query;

//         $page = $this->input->post('page');
//         $rows = $this->input->post('rows');
//         $result = array();
//         $data = "";
//         if (!empty($page) && !empty($rows)) {
//             $offset = ($page - 1) * $rows;
//             $result['total'] = $this->db->query($query)->num_rows();
//             $query .= " limit $rows offset $offset";
//             $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
//             $data = json_encode($result);
//         } else {
//             $data = json_encode($this->db->query($query)->result());
//         }
//         echo $data;
//     }

}
