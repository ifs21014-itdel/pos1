<?php

/**
 * @author Rizal.Gurning
 */
class Sales extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	function Index(){
		$this -> load -> view('sales_management/sales/view');
	}
	
	function sales_view(){
		$this -> load -> view('sales_management/sales/view_sales');
	}
	function get_data() {
		$this->load->model('sales_management/Model_sales');
		$result = $this->Model_sales->get_data();
		echo json_encode($result);
	}
	
	function get_sales_with_pagination(){
		$page = $this->input->post('page');
		$rows = $this->input->post('rows');
		$filterByReference = $this->input->post('reference');
	
		$this->load->model('sales_management/Model_sales');
		$result = $this->Model_sales->get_sales_with_pagination($page, $rows, $filterByReference);
		echo json_encode($result);
	}
        function print_form(){
		$this->load->view( 'sales_management/sales/print_form' );
	}
        
        function prints($report_date){
		$data['report_date']= $report_date;
                $this->load->model('sales_management/Model_sales');
		$data['sales'] = $this->Model_sales->getCashierSales($report_date);
		$data['sales_return'] = $this->Model_sales->getCashierSalesReturn($report_date);
                $this->load->model('system/Model_settings');
                $data['store_code'] = $this->Model_settings->get_setting_value('STORE_CODE');
                $data['store_name'] = $this->Model_settings->get_setting_value('STORE_NAME');
                $data['store_address'] = $this->Model_settings->get_setting_value('COMPANY_ADDRESS');
                $data['store_npwp'] = $this->Model_settings->get_setting_value('STORE_NPWP');
                $data['store_telp'] = $this->Model_settings->get_setting_value('COMPANY_TELEPHONE');
                $data['company_name'] = $this->Model_settings->get_setting_value('COMPANY_NAME');
                
		$this->load->view( 'sales_management/sales/print', $data );
	}
	
}
