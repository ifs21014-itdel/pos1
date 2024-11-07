<?php

/**
 * @author Rizal.Gurning
 */
class Model_customer extends MY_Model {

    public $table_name = "customer";

    public function __construct() {
        parent::__construct();
    }

    function get_customer_with_pagination($page, $rows, $filterByName) {
        $queryStruct = array(
            "select" => " c.*,ct.name customer_type_name ",
            "from" => " customer c join customer_type ct on c.customer_type_id=ct.id",
            "where" => "",
            "order_by" => " id desc "
        );
        if (!empty($filterByName)) {
            $queryStruct['where'] .= " (c.name ilike '%$filterByName%' or ct.name ilike '%$filterByName%' "
                    . " or c.barcode ilike '%$filterByName%' or c.address ilike '%$filterByName%' "
                    . " or c.gender ilike '%$filterByName%' or c.religion ilike '%$filterByName%'"
                    . " or c.city ilike '%$filterByName%' or c.state ilike '%$filterByName%'"
                    . " or c.occupation ilike '%$filterByName%' or c.phone_number ilike '%$filterByName%'"
                    . " or c.email ilike '%$filterByName%' or c.region ilike '%$filterByName%') ";
        }
        $param = array();
        return $this->get_result_with_pagination($page, $rows, $queryStruct, $param);
    }

    function add_customer($data) {
        return $this->insert($data);
    }

    function update_customer($data, $where) {
        return $this->update($data, $where);
    }

    function delete_customer($ids) {
        return $this->deletes($ids);
    }

    /* Data For Customer List Template */

    function get_customer($filterByBarcode, $filterByName, $row_count = 10) {
        $page = 1;
        $rows = $row_count;
        $queryStruct = array(
            "select" => " id, barcode, reference, name, address, discount ",
            "from" => " customer ",
            "where" => "",
            "order_by" => " id asc "
        );
        if (!empty($filterByCode)) {
            $queryStruct['where'] .= " barcode ilike '%$filterByBarcode%' ";
        }

        if (!empty($filterByLevel)) {
            if (!empty($queryStruct['where'])) {
                $queryStruct['where'] .=" or ";
            }
            $queryStruct['where'] .= " name = $filterByName ";
        }
        $param = array();

        return $this->get_result_with_pagination($page, $rows, $queryStruct, $param);
    }

    function get_customerByBarcode($barcode) {
        return $this->select_where(array("barcode" => $barcode))->row();
    }

    function get_next_card_number($type) {
        $query = "select customer_get_next_card_number($type) ct";
        return $this->db->query($query)->row()->ct;
    }

    function select_all_customer_type() {
        $this->load->model('system/Model_settings');
        $store_code = $this->Model_settings->get_store_code();
        $query = "select ct.* from customer_type ct where true ";
//         if ($store_code != '131300') {
//             $query .= " and ct.id=1";
//         }
        $query .= " order by ct.id asc ";
        //echo $query;
        return $this->db->query($query)->result();
        //print_r($settings);
    }

}
