<?php

/**
 * @author Rizal.Gurning
 */
class Model_sales extends MY_Model{
	public $table_name = "sales";
	
	public function __construct() {
		parent::__construct();
	}
	
	function get_sales_with_pagination($page, $rows, $filterByReference){
		$queryStruct = array(
			"select" => " s.id,s.reference,c.name as customer_name,s.total_price,s.total_cash,s.amount_pay_cash,
						s.credit_card_number,s.amount_pay_cash_credit_card,s.debit_card_number,
			  			s.amount_pay_cash_debit_card,s.voucher_number,s.amount_pay_cash_voucher,s.credit_card_type,
						s.debit_card_type,s.total_quantity,s.sales_date,(u.first_name||' '||u.last_name) as cashier_name ",
			"from" => " sales s left join customer c on c.id = s.customer_id left join kds_user u on u.id = s.cashier_id ",
			"where" => ""
		);
		if (!empty($filterByReference)) {
			$queryStruct['where'] .= " s.reference ilike '%$filterByReference%' ";
		}
		$param = array();
		return $this -> get_result_with_pagination($page, $rows, $queryStruct, $param);
	}
}

?>