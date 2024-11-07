<?php

/**
 * @author Rizal.Gurning
 */
class Model_sales extends MY_Model {

    public $table_name = "sales";

    public function __construct() {
        parent::__construct();
    }

    function get_sales_with_pagination($page, $rows, $filterByReference) {
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
        $queryStruct['order_by'] = " s.sales_date desc";
        $param = array();
        return $this->get_result_with_pagination($page, $rows, $queryStruct, $param);
    }

    function get_data() {
        $query = " select s.id, s.reference, s.total_price, s.total_cash from sales s where true";
        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (s.reference ilike '%$q%')";
        }
        $query .= " order by s.id asc ";
// 		return $this->execute_query_as_result($query);
        if (strlen($q) > 10) {
            return $this->db->query($query)->result();
            //return $this->execute_query_as_result($query);
        } else {
            return "";
        }
// 		echo json_encode($data);
    }
    
    function getCashierSales($date){
        $qry = "SELECT k.id, k.first_name as name, sum(s.amount_pay_cash) as cash, sum(s.amount_pay_cash_credit_card) as credit_card, 
                        sum(s.amount_pay_cash_debit_card) as debit, sum(s.amount_pay_cash_voucher) as voucher, sum(s.total_price) as total
                FROM kds_user k
                        JOIN sales s on k.id = s.cashier_id
                WHERE date(s.sales_date) = '$date'
                GROUP BY k.id, k.first_name";
        return $this->db->query($qry)->result();
    }
    
    function getCashierSalesReturn($date){
        $qry = "SELECT k.id, k.first_name as name, sum(s.price) as sales_return
                FROM kds_user k
                        JOIN sales_return s on k.id = s.created_by
                WHERE date(s.created_date) = '$date'
                GROUP BY k.id, k.first_name";
        return $this->db->query($qry)->result();
    }

}

?>