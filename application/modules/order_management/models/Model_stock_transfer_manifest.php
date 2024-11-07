<?php

/**
 * @author Rizal.Gurning
 */
class Model_stock_transfer_manifest extends MY_Model {

    public $table_name = "stock_transfer_manifest";

    public function __construct() {
        parent::__construct();
    }

    function get_stock_transfer_manifests_with_pagination($page, $rows, $filterByCode, $filterByStoreResourceName) {
        $queryStruct = array(
            "select" => " ts.id, ts.code, ts.ship_date, u.first_name as received_by, ts.received_date, 
						  case when ts.status = 1 then 'DRAFT' else case when ts.status = 2 then 'OPEN' else case when ts.status = 3 then 'RECEIVED' 
                                                    else 'CANCEL' end end end as status_info, ts.status,
						  case when ts.is_synchronized = 't' then 'SYNCRONIZE' else 'NOT SYNC' end as is_synchronized_status,			  
						  u2.first_name as delivered_by, 
						  s1.name as store_source_name, s2.name store_destination_name, s2.address as store_destination_address  ",
            "from" => " stock_transfer_manifest ts
						  join store s1 on s1.id=ts.store_source_id
						  join store s2 on s2.id=ts.store_destination_id
						  left join kds_user u on u.id = ts.received_by
						  left join kds_user u2 on u2.id = ts.user_id ",
            "where" => " store_source_id = (select value::integer from settings where key = 'STORE_ID') and store_destination_id <> (select value::integer from settings where key = 'STORE_ID')",
            "order_by" => " ts.status, is_synchronized_status , ts.created_date desc "
        );
        if (!empty($filterByCode)) {
            $queryStruct['where'] .= " code ilike '%$filterByCode%' ";
        }
        if (!empty($filterByStoreResourceName)) {
            if (!empty($queryStruct['where'])) {
                $queryStruct['where'] .=" and ";
            }
            $queryStruct['where'] .= " s1.name ilike '%$filterByStoreResourceName%' ";
        }
        $param = array();
        return $this->get_result_with_pagination($page, $rows, $queryStruct, $param);
    }

    function add_stock_transfer_manifest($code, $store_destination, $ship_date) {
        $this->load->model("system/Model_settings");
        $store_source_id = $this->Model_settings->get_setting_value("STORE_ID");

        $data = array(
// 			"code" => $code,
            "store_destination_id" => $store_destination,
            "ship_date" => $ship_date,
            "store_source_id" => $store_source_id,
            "user_id" => $this->session->userdata('id')
        );

        return $this->insert($data);
    }

    function add_stock_transfer_manifest_from_data($data) {
        return $this->insert_with_return_id($data);
    }

    function update_stock_transfer_manifest($id, $code, $store_destination, $ship_date) {
        $data = array(
            "code" => $code,
            "store_destination_id" => $store_destination,
            "ship_date" => $ship_date
        );
        $where = array(
            "id" => $id
        );
        return $this->update($data, $where);
    }

    function delete_stock_transfer_manifest($ids) {
        return $this->deletes($ids);
    }

    function confirm_stock_transfer_manifest($id) {
        $data = array(
            "status" => "2",
        );
        $where = array(
            "id" => $id
        );
        return $this->update($data, $where);
    }

    function get_code_stock_transfer_manifest_by_id($id) {
        $query = "select ts.code from stock_transfer_manifest ts where ts.id = ? ";
        $param = array(
            $id
        );
        $result = $this->execute_query_as_row($query, $param);
        if (isset($result)) {
            return $result->code;
        }
        return null;
    }

    function is_exist_stock_transfer_manifest($code) {
        $query = "select ts.id from stock_transfer_manifest ts where ts.code = ? ";
        $param = array(
            $code
        );
        $result = $this->execute_query_as_row($query, $param);
        if (isset($result)) {
            return true;
        }
        return false;
    }

    function get_stock_transfer_manifest_by_id($id) {
        $query = "select ts.id, ts.code, ts.store_source_id, ts.user_id, ts.store_destination_id, ts.ship_date,'true' as is_synchronized, ts.status
			from stock_transfer_manifest ts
			where ts.id=? ";
        $param = array(
            $id
        );

        $result = $this->execute_query_as_result($query, $param);
        return $result;
    }

    function update_status_stock_transfer_manifest($id, $status) {
        $data = array(
            "is_synchronized" => $status
        );
        $where = array(
            "id" => $id
        );
        return $this->update($data, $where);
    }

    function get_last_id($store_source_id) {
        return $this->db->query("select max(id) from stock_transfer_manifest where store_source_id=$store_source_id")->row()->max;
    }

}

?>