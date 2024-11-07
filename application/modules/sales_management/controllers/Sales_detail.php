<?php

/**
 * @author Rizal.Gurning
 */
class Sales_detail extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	function Index(){
		$note='
         <note>
            <heading>  <![CDATA[Project submission > "0" < "10]]>  </heading>
         </note>
         ';
         $xml=simplexml_load_string($note, null, LIBXML_NOCDATA);
         echo($xml ->heading);
	}
	
	function sales_detail_view(){
		$this -> load -> view('sales_management/sales/view_sales_detail');
	}
	
	function get_data() {
		$this->load->model('sales_management/Model_sales_detail');
		$result = $this->Model_sales_detail->get_data();
		echo json_encode($result);
	}
	
	function get_data_by_sales_id() {
		$sales_id = $this->input->get("sales_id");
		$this->load->model('sales_management/Model_sales_detail');
		$result = $this->Model_sales_detail->get_data_by_sales_id($sales_id);
		echo json_encode($result);
	}
	
	function get_sales_detail_with_pagination(){
		$page = $this -> input -> post('page');
		$rows = $this -> input -> post('rows');
		$filterBySalesId = $this -> input-> post('sales_id');
		$filterByItemBarcode = $this -> input-> post('item_barcode');
		$filterByItemName = $this -> input-> post('item_name');
	
		$this -> load -> model('Model_sales_detail');
		$result = $this -> Model_sales_detail -> get_sales_details_with_pagination($page, $rows, $filterBySalesId, $filterByItemBarcode, $filterByItemName);
		echo json_encode($result);
	}
}
