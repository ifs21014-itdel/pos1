<?php

/**
 * @author Rizal.Gurning
*/
class Model_vendor extends MY_Model {

	public $table_name = "vendor";

	public function __construct() {
		parent::__construct ();
	}
	function get_data() {
		$query = " select * from vendor where true";
		$q = $this->input->post('q');
		if (!empty($q)) {
			$query .= " and (code ilike '%$q%' or name ilike '%$q%' )";
		}
		$query .= " order by id asc ";
		$data = json_encode($this->db->query($query)->result());
		echo $data;
	}

	function get_vendor_with_pagination($page, $rows, $filterByName){
		$queryStruct = array(
				"select" => " id, name, code, npwp, phone_number, contact_name, contact_number, discount,
						  discount_promotion, address, term_of_payment, pkp",
				"from" => " vendor ",
				"where" => "",
				"order_by" => " id asc "
		);
		if (!empty($filterByName)) {
			$queryStruct['where'] .= " name ilike '%$filterByName%' or code ilike '%$filterByName%'";
		}

		$param = array();
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}

	function add_vendor($code, $name, $npwp, $phone_number,
			$contact_name, $contact_number, $discount, $discount_promotion, $address,
			$term_of_payment, $pkp){
		$data = array(
				"code" => $code,
				"name" => $name,
				"npwp" => $npwp,
				"phone_number" => $phone_number,
				"contact_name" => $contact_name,
				"contact_number" => $contact_number,
				"discount" => $discount,
				"discount_promotion" => $discount_promotion,
				"address" => $address,
				"term_of_payment" => $term_of_payment,
				"pkp" => $pkp
		);
		return $this -> insert($data);
	}

	function update_vendor($id, $code, $name, $npwp, $phone_number,
			$contact_name, $contact_number, $discount, $discount_promotion, $address,
			$term_of_payment, $pkp){
		$data = array(
				"code" => $code,
				"name" => $name,
				"npwp" => $npwp,
				"phone_number" => $phone_number,
				"contact_name" => $contact_name,
				"contact_number" => $contact_number,
				"discount" => $discount,
				"discount_promotion" => $discount_promotion,
				"address" => $address,
				"term_of_payment" => $term_of_payment,
				"pkp" => $pkp
		);
		$where = array(
				"id" => $id
		);
		return $this -> update($data, $where);
	}

	function delete_vendor($ids){
		return $this -> deletes($ids);
	}

	function select_by_id($id){
		$query = "select * from vendor";
		return $this->db->query($query)->row();
		// 		print_r($query);exit();
	}

}