<?php

/**
 * @author Rizal.Gurning
 */
class Model_bom extends MY_Model {

    public $table_name = "bill_of_materials_item";

    public function __construct() {
        parent::__construct();
    }

//     function get_data() {
//         $query = " select item.* from item where true";
//         $q = $this->input->post('q');
//         if (!empty($q)) {
//             $query .= " and (item.sku ilike '%$q%' or item.name ilike '%$q%' or item.barcode ilike '%$q%')";
//         }
//         $query .= " order by item.id asc ";
//         $data = array();
//         if(strlen($q) > 5){
//             //var_dump($q);
//             $data = $this->db->query($query)->result();
//         }
//         echo json_encode($data);
//     }

    function get_bom_with_pagination($page, $rows, $filterByName) {
        $queryStruct = array(
            "select" => "bom.* ",
            "from" => " bill_of_materials_item bom",
            "where" => " ",
            "order_by" => " id desc "
        );
        if (!empty($filterByName)) {
            $queryStruct['where'] .= " i.name ilike '%$filterByName%' or i.barcode ilike '%$filterByName%' or i.sku ilike '%$filterByName%'";
        }
        $param = array();
        return $this->get_result_with_pagination($page, $rows, $queryStruct, $param);
    }

    function add_item($sku, $name, $barcode, $cost, $category1, $category2, $category3, $category4, $uom_id, $carton, $inner, $retail_price, $bkp, $consignment, $type, $trading_price, $bom_status) {
        $data = array(
            "sku" => $sku,
            "name" => $name,
            "barcode" => $barcode,
            "cost" => $cost,
            "category1" => $category1,
            "category2" => $category2,
            "category3" => $category3,
            "category4" => $category4,
            "uom_id" => $uom_id,
            "carton" => $carton,
            "inner" => $inner,
            "retail_price" => $retail_price,
            "taxed" => $bkp,
            "consignment" => $consignment,
            "type" => $type,
            "trading_price" => $trading_price,
            "bom_status" => $bom_status
        );
        return $this->insert($data);
    }

    function update_item($id, $sku, $name, $barcode, $cost, $category1, $category2, $category3, $category4, $uom_id, $carton, $inner, $retail_price, $bkp, $consignment, $type, $trading_price, $bom_status) {
        $data = array(
            "sku" => $sku,
            "name" => $name,
            "barcode" => $barcode,
            "cost" => $cost,
            "category1" => $category1,
            "category2" => $category2,
            "category3" => $category3,
            "category4" => $category4,
            "uom_id" => $uom_id,
            "carton" => $carton,
            "inner" => $inner,
            "retail_price" => $retail_price,
            "taxed" => $bkp,
            "consignment" => $consignment,
            "type" => $type,
            "trading_price" => $trading_price,
            "bom_status" => $bom_status
        );
        $where = array(
            "id" => $id
        );
// 		print_r($data);
// 		exit;
        return $this->update($data, $where);
    }

    function delete_item($ids) {
        return $this->deletes($ids);
    }
    
//     function get_uom_id_by_id($id) {
//         $query = "select uom_id from item where id = $id";
//         $result = $this->db->query($query);
//         if ($result->num_rows() > 0)
//         {
//            $row = $result->row(); 
//            return $row->uom_id;
//         } else return 0;
//     }


}
