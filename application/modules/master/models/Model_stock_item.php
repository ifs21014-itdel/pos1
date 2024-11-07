<?php

/**
 * @author Rizal.Gurning
 */
class Model_stock_item extends MY_Model {

    public $table_name = "stock_item";

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
//         $data = json_encode($this->db->query($query)->result());
//         echo $data;
//     }

    function get_stock_item_with_pagination($page, $rows, $filterByName, $filterByStore) {
        $queryStruct = array(
            "select" => " si.id, si.stock, si.minimum, si.maximum, si.store_id, i.sku sku, i.barcode barcode, i.name item_name, s.name store_name",
        	"from" => " stock_item si
		        		join item i on  si.item_id = i.id
						join store s on si.store_id = s.id",
            "where" => " 1 = 1 ",
            "order_by" => " i.name,s.name asc "
        );
        if (!empty($filterByName)) {
            $queryStruct['where'] .= " and ( i.name ilike '%$filterByName%' or i.barcode ilike '%$filterByName%' or i.sku ilike '%$filterByName%' ) ";
        }
        if (!empty($filterByStore)) {
        	$queryStruct['where'] .= " and si.store_id = $filterByStore ";
        }
//         print_r($queryStruct);exit();
        $param = array();
        return $this->get_result_with_pagination($page, $rows, $queryStruct, $param);
    }

//     function add_item($sku, $name, $barcode, $cost, $category1, $category2, $category3, $category4, $uom_id, $carton, $inner, $retail_price, $bkp, $consignment, $type, $trading_price, $bom_status) {
//         $data = array(
//             "sku" => $sku,
//             "name" => $name,
//             "barcode" => $barcode,
//             "cost" => $cost,
//             "category1" => $category1,
//             "category2" => $category2,
//             "category3" => $category3,
//             "category4" => $category4,
//             "uom_id" => $uom_id,
//             "carton" => $carton,
//             "inner" => $inner,
//             "retail_price" => $retail_price,
//             "taxed" => $bkp,
//             "consignment" => $consignment,
//             "type" => $type,
//             "trading_price" => $trading_price,
//             "bom_status" => $bom_status
//         );
//         return $this->insert($data);
//     }

//     function update_item($id, $sku, $name, $barcode, $cost, $category1, $category2, $category3, $category4, $uom_id, $carton, $inner, $retail_price, $bkp, $consignment, $type, $trading_price, $bom_status) {
//         $data = array(
//             "sku" => $sku,
//             "name" => $name,
//             "barcode" => $barcode,
//             "cost" => $cost,
//             "category1" => $category1,
//             "category2" => $category2,
//             "category3" => $category3,
//             "category4" => $category4,
//             "uom_id" => $uom_id,
//             "carton" => $carton,
//             "inner" => $inner,
//             "retail_price" => $retail_price,
//             "taxed" => $bkp,
//             "consignment" => $consignment,
//             "type" => $type,
//             "trading_price" => $trading_price,
//             "bom_status" => $bom_status
//         );
//         $where = array(
//             "id" => $id
//         );
// // 		print_r($data);
// // 		exit;
//         return $this->update($data, $where);
//     }

//     function delete_item($ids) {
//         return $this->deletes($ids);
//     }

}
