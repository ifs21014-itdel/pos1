<?php

/**
 * @author Rizal.Gurning
 */
class Model_price_item_store extends MY_Model {

    public $table_name = "price_item_store";

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

    function get_price_item_store_with_pagination($page, $rows, $filterByName, $filterByStore) {
        $queryStruct = array(
            "select" => " pis.*, i. sku, i.barcode, i.name item_name, s.name store_name ",
            "from" => " price_item_store pis
        				join item i on pis.item_id = i.id
						join store s on pis.store_id = s.id",
            "where" => " true ",
            "order_by" => " i.name,s.name asc "
        );
        if (!empty($filterByName)) {
            $queryStruct['where'] .= " and (i.name ilike '%$filterByName%' or i.barcode ilike '%$filterByName%' or i.sku ilike '%$filterByName%' )";
        }
        if (!empty($filterByStore)) {
            $queryStruct['where'] .= " and pis.store_id = $filterByStore ";
        }
//         print_r($queryStruct);exit();
        $param = array();
        return $this->get_result_with_pagination($page, $rows, $queryStruct, $param);
    }

    function add_price_item_store($item_id, $store_id, $retail_price, $cost) {
        $data = array(
            "retail_price" => $retail_price,
            "cost" => $cost
        );
        $where = " item_id = $item_id";
        if (!empty($store_id)) {
            $where.= " and store_id = $store_id";
        }
        // 		print_r($data);
        // 		exit;
        return $this->update($data, $where);
//         $data = array(
//             "item_id" => $item_id,
//         	"store_id" => $store_id,
//         	"retail_price" => $retail_price,
//         	"cost" => $cost
//         );
//         return $this->insert($data);
    }

    function update_price_item_store($id, $item_id, $store_id, $retail_price, $cost) {
        $data = array(
            "item_id" => $item_id,
            "store_id" => $store_id,
            "retail_price" => $retail_price,
            "cost" => $cost
        );
        $where = array(
            "id" => $id
        );
// 		print_r($data);
// 		exit;
        return $this->update($data, $where);
    }

    function delete_price_item_store($ids) {
        return $this->deletes($ids);
    }

}
