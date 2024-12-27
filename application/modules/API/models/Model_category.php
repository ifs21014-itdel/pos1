<?php

class Model_category extends MY_Model {
	
	public $table_name = "category";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get_data($level) {
		// Ambil data kategori berdasarkan level
		$query = "SELECT * FROM category WHERE true";
		if($level != 0){
			$query .= " AND level = $level";
		}
		$query .= " ORDER BY id ASC";
		
		// Jalankan query dan ambil hasilnya
		$data = $this->db->query($query)->result();
		
		// Periksa apakah data ada
		if (!empty($data)) {
			// Jika ada data, kirimkan data tersebut dengan status success
			echo json_encode([
				'status' => 'success',
				'data' => $data
			]);
		} else {
			// Jika data tidak ditemukan, kirimkan status success dan data null
			echo json_encode([
				'status' => 'success',
				'data' => null,
				'message' => 'No categories found'  // Pesan jika kategori tidak ditemukan
			]);
		}
		exit; // Jangan lupa exit setelah echo json_encode
	}
	
	
	function get_categories_with_pagination($page, $rows, $filterByName, $filterByLevel){
		$queryStruct = array(
			"select" => " id, name, level, parent_id ",
			"from" => " category ",
			"where" => "",
			"order_by" => " id asc "
		);
		if (!empty($filterByName)) {
			$queryStruct['where'] .= " name ilike '%$filterByName%' ";
		}
		if (!empty($filterByLevel)) {
			if (!empty($queryStruct['where'])) {
				$queryStruct['where'] .=" and ";
			}
			$queryStruct['where'] .= " level = $filterByLevel ";
		}
		$param = array();
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}
	
	function add_category($name, $level, $parent_id){
		$data = array(
			"name" => $name,
			"level" => $level,
			"parent_id" => $parent_id
		);
		return $this -> insert($data);
	}

	function update_category($id, $name, $level, $parent_id){
		$data = array(
			"name" => $name,
			"level" => $level,
			"parent_id" => $parent_id
		);
		$where = array(
			"id" => $id
		);
		return $this -> update($data, $where);
	}
	
	function delete_category($ids){
		return $this -> deletes($ids);
	}
}