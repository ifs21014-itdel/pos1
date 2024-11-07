<?php
/**
 *
 * @author Rizal Gurning
 */
class MY_Model extends CI_Model{
	/**
	 * This field describe TABLE that used by thid model, override it to re-define TABLE name
	 * 
	 * <br/> ex: $table_name = "kds_user";
	 * @var String
	 */
	public $table_name = "";

	function __construct(){
		parent::__construct();
	}

	public function last_sequence_id($table_name_=""){
		$table_name = $this->table_name!="" ? $this->table_name : $table_name_ !="" ? $table_name_ : "";
		
		if($table_name != ""){
			$seq_name = $table_name . "_id_seq";
			$query = "SELECT last_value FROM $seq_name;"; 
			$result = $this ->db -> query($query) -> row();
			if (isset($result)){
				return $result -> last_value;
			}
		}
		return 1;//default
	}
	
	public function select_all(){
		return $this -> db -> get($this -> table_name) -> result();
	}
	
	public function select_where($where){
		return $this -> db -> get_where($this -> table_name, $where) -> row();
	}
	
	public function insert($data){
		return $this -> db -> insert($this -> table_name, $data);
	}
	
	public function insert_with_return_id($data){
		$this -> db -> insert($this -> table_name, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	public function insert_batch($data){
		return $this->db->insert_batch($this -> table_name, $data);
	}

	public function update($data, $where){
		return $this -> db -> update($this -> table_name, $data, $where);
	}

	public function delete($where){
		return $this -> db -> delete($this -> table_name, $where);
	}
	
	function deletes($ids){
		if(is_array($ids)){
			foreach ($ids as $id){
				$where = array(
					"id" => $id
				);
				$this -> delete($where);
			}
		}else{
			$where = array(
				"id" => $ids
			);
			$this -> delete($where);
		}
		return true;
	}
	
	public function execute_query($query, $param = array()){
		return $this -> db -> query($query, $param);
	}
	
	public function execute_query_as_row($query, $param){
		return $this -> db -> query($query, $param)->row();
	}
	
	public function execute_query_as_result($query, $param){
		return $this -> db -> query($query, $param)->result();
	}
	
	/**
	 * Get Constructed SQL Count
	 *
	 * @param Array $queryStruct
	 * @return string queryCount
	 */
	public function get_query_count($queryStruct){
		if( !is_array($queryStruct) && array_key_exists("from", $queryStruct) ){
			show_error_module_application("Param 'queryStruct' doesn't contain 'from' query", 500, "Param 'queryStruct' Not Valid");
		}else{
			$queryCount = " select count(1) as total from ".$queryStruct['from'];
			if( array_key_exists("where", $queryStruct)){
				$where = trim($queryStruct['where']) ;
				if(!empty( $where)){
					$queryCount .= " where " . $queryStruct['where'];	
				}
			}
			
			if( array_key_exists("having", $queryStruct) ){
				$having = trim($queryStruct['having']) ;
				if(!empty( $having )){
					$queryCount .= " having " . $queryStruct['having'];
				}
			}
			return $queryCount;
		}
	}
	
	/**
	 * Get Constructed SQL Select
	 *
	 * @param Array $queryStruct
	 * @return string querySelect
	 */
	public function get_query_select($queryStruct){
		if( !is_array($queryStruct) && !array_key_exists("select", $queryStruct) && array_key_exists("from", $queryStruct) ){
			show_error_module_application("Param 'queryStruct' doesn't contain 'select' & 'from' query", 500, "Param 'queryStruct' Not Valid");
		}else{
			$sqlSelect = " select " . $queryStruct['select'] . " from " . $queryStruct['from'];
			
			if( array_key_exists("where", $queryStruct) ){
				$where = trim($queryStruct['where']);
				if(!empty( $where )){
					$sqlSelect .= " where " . $queryStruct['where'];
				}
			}
			
			if( array_key_exists("group_by", $queryStruct)){
				$group_by = trim($queryStruct['group_by']);
				if(!empty( $group_by ) ){
					$sqlSelect .= " group by " . $queryStruct['group_by'];
				}
			}
			
			if( array_key_exists("having", $queryStruct) ){
				$having = trim($queryStruct['having']);
				if(!empty( $having )){
					$sqlSelect .= " having " . $queryStruct['having'];
				}
			}
			
			if( array_key_exists("order_by", $queryStruct) ){
				$order_by = trim($queryStruct['order_by']);
				if(!empty( $order_by )){
					$sqlSelect .= " order by " . $queryStruct['order_by'];
				}
			}
			return $sqlSelect;
		}
	}
	
	/**
	 * Get Count
	 *
	 * @param Array $queryStruct
	 * @param Array $param
	 * @return integer count
	 */
	public function get_count($queryStruct, $param){
		$queryCount = $this -> get_query_count($queryStruct);
		$query = $this ->db -> query($queryCount, $param) -> row();
		if (isset($query)){
			return $query -> total;
		}else{
			return 0;
		}
	}
	
	/**
	 * get Result per paging
	 *<br/>ex-param:
	 *<br/>   $queryStruct = array {
	 *<br/> 	 "field" => "id, ...",
	 *<br/> 	 "from" => " user u join ... ",
	 *<br/>      "criteria" => " where u.id = 1 and .."
	 *<br/>   }
	 *
	 * @param unknown $page
	 * @param unknown $rows
	 * @param unknown $queryStruct
	 * @param unknown $param
	 * @return string
	 */
	public function get_result_with_pagination($page, $rows, $queryStruct, $param){
		if($page > 0){
			$page = ($page - 1);
		}
		$offset = $page * $rows;
		$result = array(
			"total" => $this->get_count($queryStruct, $param)
		);
		$query = $this -> get_query_select($queryStruct);
		$query .= " limit ".$rows." offset ".$offset." ";
		$resulset = $this->execute_query($query, $param) -> result();

		return array_merge($result, array('rows' => $resulset));
	}
	
	public function get_result_empty_with_pagination(){
		$result_empty = array(
			"total" => 0,
			'rows' => array()
		);
		return result_empty;
	}
}
