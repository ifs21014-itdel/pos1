<?php

/**
 * @author Rizal.Gurning
 */
class Model_item extends MY_Model {

    public $table_name = "item";

    public function __construct() {
        parent::__construct();
    }

    function get_data() {
    	$q = $this->input->post('q');
    	$data = "";
        if (!empty($q) ) {
    		$query = "select * from item where status_sku='ACTIVE' AND (";
    		$item_id = trim($q);
    		if (is_numeric($item_id)) {
    			$query.= " id = $item_id or sku ilike '%$item_id%' or barcode ilike '%$item_id%') order by name ";
    			$data = $this->db->query($query)->result();
    			//var_dump($query); var_dump($data); exit;
    		} else if (strlen($q)>5) { 
	    		$query.= " sku ilike '%$q%' or barcode ilike '%$q%' or name ilike '%$q%') order by name ";
	    		$data = $this->db->query($query)->result();
	    		//var_dump($query); var_dump($data); exit;
    		}  
    	}
    	return $data;
    }
    
    function get_data_by_barcode() {
    	$q = $this->input->post('barcode');
    	$query = " select * from item where barcode = '$q' limit 1";
    	$data = $this->db->query($query)->result();
    	//var_dump($data); exit();
    	echo json_encode($data);
    }

    function get_item_with_pagination($page, $rows, $filterByName, $filterBySku) {
        $queryStruct = array(
            "select" => " i.*, uom.code unit_code, c1.name as category1_name, c2.name as category2_name,
				c3.name as category3_name, c4.name as category4_name,
				case when i.taxed = 't' then 'YES' else 'NO' end as bkp,
				round(CAST(float8 ((i.retail_price - i.cost)/ case when i.retail_price =0 then 1 else i.retail_price end)*100 as numeric),2) as gp ",
            "from" => " item i
				join uom on i.uom_id = uom.id
				join category c1 on c1.id = i.category1
				join category c2 on c2.id = i.category2
				join category c3 on c3.id = i.category3
				join category c4 on c4.id = i.category4 ",
            "where" => " ",
            "order_by" => " id desc "
        );
        if (!empty($filterByName)) {
            $queryStruct['where'] .= " i.name ilike '%$filterByName%' or i.barcode ilike '%$filterByName%' or i.sku ilike '%$filterByName%'";
        }
        if (!empty($filterBySku)) {
            $queryStruct['where'] .= " i.status_sku = '$filterBySku' ";
        }
        $param = array();
        return $this->get_result_with_pagination($page, $rows, $queryStruct, $param);
    }

    function add_item($sku, $name, $barcode, $cost, $category1, $category2, $category3, $category4, $uom_id, $carton, $inner, $retail_price, $bkp, $consignment, $type, $trading_price, $bom_status, $status_sku) {
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
            "bom_status" => $bom_status,
            "status_sku" => $status_sku
        );
        return $this->insert($data);
    }

    function update_item($id, $sku, $name, $barcode, $cost, $category1, $category2, $category3, $category4, $uom_id, $carton, $inner, $retail_price, $bkp, $consignment, $type, $trading_price, $bom_status, $status_sku) {
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
            "bom_status" => $bom_status,
            "status_sku" => $status_sku
        );
        if($status_sku=='DISCONTINUE'){
            $data["barcode"]=0;
        }
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
    
    function get_uom_id_by_id($id) {
        $query = "select uom_id from item where id = $id";
        $result = $this->db->query($query);
        if ($result->num_rows() > 0)
        {
           $row = $result->row(); 
           return $row->uom_id;
        } else return 0;
    }
    
    function getAll(){
        $query = "select i.*, uom.code unit_code, c1.name as category1_name, c2.name as category2_name,
			c3.name as category3_name, c4.name as category4_name,
                        case when i.type = 1 then 'RETAIL' when i.type=2 then 'MATERIAL' else 'TRADING' end as type
                from item i
                        join uom on i.uom_id = uom.id
                        join category c1 on c1.id = i.category1
                        join category c2 on c2.id = i.category2
                        join category c3 on c3.id = i.category3
                        join category c4 on c4.id = i.category4 
                order by name";
        return $this->db->query($query)->result();
    }
    
    function get_category2($category1){
        $query="select * FROM category where parent_id='$category1'";
        $data=$this->db->query($query)->result();
        return  json_encode($data);
    }
    
    function get_category3($category2){
        $query="select * FROM category where parent_id='$category2'";
        $data=$this->db->query($query)->result();
        return  json_encode($data);
    }
    
    function get_category4($category3){
        $query="select * FROM category where parent_id='$category3'";
        $data=$this->db->query($query)->result();
        return  json_encode($data);
    }

}
