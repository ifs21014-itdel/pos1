<?php

/**
 * @author Rizal.Gurning
 */
class Model_sales_percashier extends MY_Model {
	
	public $table_name = "";
	
	public function __construct() {
		parent::__construct ();
	}
	
	function get_sales_percashier_with_pagination($page, $rows){
		$queryStruct = array(
			"select" => " k.first_name, sum(s.amount_pay_cash) as cash, 
							sum(s.amount_pay_cash_debit_card) as debit_card, 
							sum(s.amount_pay_cash_credit_card) as credit_card, 
							sum(s.amount_pay_cash_voucher) as voucher, 
							sum(s.total_price) as total  ",
			"from" => " sales s join kds_user k on s.cashier_id = k.id ",
			"where" => " date(s.sales_date) = date(now()) " . " first_name = '" . Authority::getUserId() . "' ",
			"group_by" => " k.first_name ",
			"order_by" => " 1 "
		);
		$param = array();
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}
	
}