<?php

/**
 * Controller po
 *
 * @author Razal.Gurning
 */
class Good_receive_ts extends MX_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'Model_good_receive_ts' );
	}
	function index() {
		$this->load->view ( 'order_management/good_receive_ts/index' );
	}
	function get() {
		echo $this->Model_good_receive_ts->get();
	}
	function view_list() {
		$this->load->view ( 'order_management/good_receive_ts/view_list' );
	}
	function detail_gr_ts(){
		$this->load->view('order_management/good_receive_ts/detail_gr_ts');
	}
	
	function item_get(){
		echo $this->Model_good_receive_ts->get_item();
	}
	function item_delete() {
		$this->Model_good_receive_ts->item_delete();
	}
	// status GR 'received'
	function gr_ts_receive() {
		$this->Model_good_receive_ts->update(array('is_synchronized_received'=>true,'status'=>'3', 'received_date'=>'now()', 'received_by'=>Authority::getUserId()), array('id'=>$this->input->post('id')));
	}
	function prints($id){
		$data['gr_ts'] = $this->Model_good_receive_ts->select_by_id($id);
		$data['item'] = $this->Model_good_receive_ts->select_item_by_ts_id($id);
		$this->load->view('order_management/good_receive_ts/print',$data);
	}
}
