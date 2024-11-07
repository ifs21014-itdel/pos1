<?php

/**
 * Controller Item
 *
 * @author Razal.Gurning
 */
class Item extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_item');
    }

    function index() {
        $this->load->view('master/item/index');
    }

    function get_data() {
        $result = $this->model_item->get_data();
        echo json_encode($result);
    }
    
    function get_data_by_barcode() {
    	$this->model_item->get_data_by_barcode();
    }
    

    function get_item_with_pagination() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $filterByName = $this->input->post('search');
        $filterBySku = $this->input->post('status_sku');
        $result = $this->model_item->get_item_with_pagination($page, $rows, $filterByName, $filterBySku);
        echo json_encode($result);
    }

    function view_list() {
        $this->load->view('master/item/view_list');
    }

    function input_form() {
        $this->load->view('master/item/input_form');
    }

    function add_item() {
        $sku = $this->input->post('sku');
        $name = $this->input->post('name');
        $barcode = $this->input->post('barcode');
        $cost = $this->input->post('cost');
        $category1 = $this->input->post('category1');
        $category2 = $this->input->post('category2');
        $category3 = $this->input->post('category3');
        $category4 = $this->input->post('category4');
        $uom_id = $this->input->post('uom_id');
        $carton = $this->input->post('carton');
        $inner = $this->input->post('inner');
        $retail_price = $this->input->post('retail_price');
        $trading_price = $this->input->post('trading_price');
        $bkp = $this->input->post('taxed');
        $consignment = $this->input->post('consignment');
        $type = $this->input->post('type');
        $bom_status = $this->input->post('bom_status');
        $status_sku = $this->input->post('status_sku');
        $isSuccess = $this->model_item->add_item($sku, $name, $barcode, $cost, $category1, $category2, $category3, $category4, $uom_id, $carton, $inner, $retail_price, $bkp, $consignment, $type, $trading_price, $bom_status, $status_sku);
        $this->getMessageResult($isSuccess);
    }

    function update_item() {
        $id = $this->input->post('id');
        $sku = $this->input->post('sku');
        $name = $this->input->post('name');
        $barcode = $this->input->post('barcode');
        $cost = $this->input->post('cost');
        $category1 = $this->input->post('category1');
        $category2 = $this->input->post('category2');
        $category3 = $this->input->post('category3');
        $category4 = $this->input->post('category4');
        $uom_id = $this->input->post('uom_id');
        $carton = $this->input->post('carton');
        $inner = $this->input->post('inner');
        $retail_price = $this->input->post('retail_price');
        $bkp = $this->input->post('taxed');
        $consignment = $this->input->post('consignment');
        $type = $this->input->post('type');
        $trading_price = $this->input->post('trading_price');
        $bom_status = $this->input->post('bom_status');
        $status_sku = $this->input->post('status_sku');
        $isSuccess = $this->model_item->update_item($id, $sku, $name, $barcode, $cost, $category1, $category2, $category3, $category4, $uom_id, $carton, $inner, $retail_price, $bkp, $consignment, $type, $trading_price, $bom_status, $status_sku);
        $this->getMessageResult($isSuccess);
    }

    function delete_item() {
        $id = $this->input->post('id');
        $isSuccess = $this->model_item->delete_item($id);
        $this->getMessageResult($isSuccess);
    }

    function bom($itemid) {
        $data["itemid"] = $itemid;
        $this->load->view('master/item/bom', $data);
    }

    function bom_input() {
        $this->load->view('master/item/bom_input');
    }

    function bom_save($itemid, $id) {
        $data = array(
            "raw_item_id" => $this->input->post("raw_item_id"),
            "uom_id" => $this->input->post("uom_id"),
            "qty" => $this->input->post("qty")
        );

        if ($id == 0) {
            $data["item_id"] = $itemid;
            if ($this->db->insert("bill_of_materials_item", $data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->db->update("bill_of_materials_item", $data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function bom_delete() {
        if ($this->db->delete("bill_of_materials_item", array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function bom_get($itemid = 0) {
        $query = "
            select bill_of_materials_item.*,item.sku,item.barcode,item.name,uom.code unit_code from bill_of_materials_item 
            join item on bill_of_materials_item.raw_item_id=item.id
            join uom on item.uom_id=uom.id
            where bill_of_materials_item.item_id=$itemid
            ";
        $query .= " order by bill_of_materials_item.id desc ";

//        echo $query;

        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        echo $data;
    }
    
    
    function export_to_excel() {
        $items = $this->model_item->getAll();
        //var_dump($items);
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=item-" . date('Y-m-d') . ".xls");

        $excel = '<table border="1">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID</th>
                        <th>SKU</th>
                        <th>Barcode</th>
                        <th>Nama</th>
                        <th>Satuan</th>
                        <th>CTN</th>
                        <th>INR</th>
                        <th>Cost/HPP</th>
                        <th>Retail Price</th>
                        <th>Trading Price</th>
                        <th>Category I</th>
                        <th>Category II</th>
                        <th>Category III</th>
                        <th>Category IV</th>
                        <th>TYPE</th>
                        <th>BKP</th>
                        <th>Consingment</th>
                        <th>BOM Status</th>
                    </tr>
                    </thead>
                    <tbody>';
        $i = 0;
        foreach ($items as $item) {
            $i++;
            $excel .= '<tr>
                        <td>' . $i . '</td>
                        <td>' . $item->id . '</td>
                        <td>' . $item->sku . '</td>
                        <td>' . $item->barcode . '</td>
                        <td>' . $item->name . '</td>
                        <td>' . $item->unit_code . '</td>
                        <td>' . $item->carton . '</td>
                        <td>' . $item->inner . '</td>
                        <td>' . $item->cost . '</td>
                        <td>' . $item->retail_price . '</td>
                        <td>' . $item->trading_price . '</td>
                        <td>' . $item->category1_name . '</td>
                        <td>' . $item->category2_name . '</td>
                        <td>' . $item->category3_name . '</td>
                        <td>' . $item->category4_name . '</td>
                        <td>' . $item->type . '</td>
                        <td>' . $item->taxed. '</td>
                        <td>' . $item->consignment . '</td>
                        <td>' . $item->bom_status . '</td>

                    </tr>';
        }

        $excel .= '</tbody>
                    </table>';
        echo $excel;
        die();
    }
 
    function get_category2($category1){
        $this->load->model('Model_item');
        echo $this->Model_item->get_category2($category1);
    }
    
    function get_category3($category2){
        $this->load->model('Model_item');
        echo $this->Model_item->get_category3($category2);
    }
    
    function get_category4($category3){
        $this->load->model('Model_item');
        echo $this->Model_item->get_category4($category3);
    }
}
