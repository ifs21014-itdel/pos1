<?php

/**
 * @author Rizal.Gurning
 */
class Model_card_type extends MY_Model {
	
	public $table_name = "card_type";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get_credit_card_type() {
		$query = " select id, name, description from card_type where is_credit_type = true and active = true order by name asc ";
		return $this->execute_query_as_result($query, null);
	}
	
	function get_debit_card_type() {
		$query = " select id, name, description from card_type where is_debit_type = true and active = true order by name asc ";
		return $this->execute_query_as_result($query, null);
	}
	
}